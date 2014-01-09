<?php

namespace ZenDesk\Rest\Client\Builder;

use RestRemoteObject\Client\Rest\Context;
use RestRemoteObject\Client\Rest\Builder\AbstractBuilder;

class TriggerBuilder extends AbstractBuilder
{
    protected $relatedClass = 'ZenDesk\Service\Remote\TriggerServiceInterface';

    public function persist(Context $context)
    {
        $params = $context->getResourceBinder()->getParams();
        /** @var \ZenDesk\Entity\Trigger $trigger */
        $trigger = $params[0];

        $data = array(
            'trigger' => array(
                'title' => $trigger->getTitle(),
                'active' => $trigger->getActive(),
                'position' => $trigger->getPosition(),
                'actions' => array(),
                'all' => array(),
                'any' => array(),
            ),
        );

        $conditions = $trigger->getConditions();
        foreach ($conditions as $condition) {
            $data['trigger'][$condition->getType()][] = array(
                'field' => $condition->getField(),
                'operator' => $condition->getOperator(),
                'value' => $condition->getValue(),
            );
        }

        $actions = $trigger->getActions();
        foreach ($actions as $action) {
            $data['trigger']['actions'][] = array(
                'field' => $action->getField(),
                'value' => $action->getValue(),
            );
        }

        if (empty($data['trigger']['any'])) {
            unset($data['trigger']['any']);
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