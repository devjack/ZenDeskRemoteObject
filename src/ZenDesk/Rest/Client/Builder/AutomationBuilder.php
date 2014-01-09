<?php

namespace ZenDesk\Rest\Client\Builder;

use RestRemoteObject\Client\Rest\Context;
use RestRemoteObject\Client\Rest\Builder\AbstractBuilder;

class AutomationBuilder extends AbstractBuilder
{
    protected $relatedClass = 'ZenDesk\Service\Remote\AutomationServiceInterface';

    public function persist(Context $context)
    {
        $params = $context->getResourceBinder()->getParams();
        /** @var \ZenDesk\Entity\Automation $automation */
        $automation = $params[0];

        $data = array(
            'automation' => array(
                'title' => $automation->getTitle(),
                'active' => $automation->getActive(),
                'position' => $automation->getPosition(),
                'actions' => array(),
                'all' => array(),
                'any' => array(),
            ),
        );

        $conditions = $automation->getConditions();
        foreach ($conditions as $condition) {
            $data['automation'][$condition->getType()][] = array(
                'field' => $condition->getField(),
                'operator' => $condition->getOperator(),
                'value' => $condition->getValue(),
            );
        }

        $actions = $automation->getActions();
        foreach ($actions as $action) {
            $data['automation']['actions'][] = array(
                'field' => $action->getField(),
                'value' => $action->getValue(),
            );
        }

        if (empty($data['automation']['any'])) {
            unset($data['automation']['any']);
        }

        $context
            ->getResourceBinder()
            ->setParams(json_encode($data));
    }

    public function save(Context $context)
    {
        $this->persist($context);
    }
}