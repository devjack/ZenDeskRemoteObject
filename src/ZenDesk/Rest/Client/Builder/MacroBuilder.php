<?php

namespace ZenDesk\Rest\Client\Builder;

use RestRemoteObject\Client\Rest\Context;
use RestRemoteObject\Client\Rest\Builder\AbstractBuilder;

class MacroBuilder extends AbstractBuilder
{
    protected $relatedClass = 'ZenDesk\Service\Remote\MacroServiceInterface';

    public function persist(Context $context)
    {
        $params = $context->getResourceBinder()->getParams();
        /** @var \ZenDesk\Entity\Macro $macro */
        $macro = $params[0];

        $data = array(
            'macro' => array(
                'title' => $macro->getTitle(),
                'active' => $macro->getActive(),
                'actions' => array(),
            ),
        );

        $restriction = $macro->getRestriction();
        if ($restriction) {
            $data['macro']['restriction'] = array(
                'type' => $restriction->getType(),
                'id' => $restriction->getId(),
            );
        }

        $actions = $macro->getActions();
        foreach ($actions as $action) {
            $data['macro']['actions'][] = array(
                'field' => $action->getField(),
                'value' => $action->getValue(),
            );
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