<?php

namespace ZenDesk\Rest\Client\Builder;

use RestRemoteObject\Client\Rest\Context;
use RestRemoteObject\Client\Rest\Builder\AbstractBuilder;

class ViewBuilder extends AbstractBuilder
{
    protected $relatedClass = 'ZenDesk\Service\Remote\ViewServiceInterface';

    public function persist(Context $context)
    {
        $params = $context->getResourceBinder()->getParams();
        /** @var \ZenDesk\Entity\View $view */
        $view = $params[0];

        $data = array(
            'view' => array(
                'title' => $view->getTitle(),
                'active' => $view->getActive(),
                'all' => array(),
                'any' => array(),
            ),
        );

        $conditions = $view->getConditions();
        foreach ($conditions as $condition) {
            $data['view'][$condition->getType()][] = array(
                'field' => $condition->getField(),
                'operator' => $condition->getOperator(),
                'value' => $condition->getValue(),
            );
        }

        $execution = $view->getExecution();
        if ($execution) {
            $columns = $execution->getColums();
            if ($columns) {
                $data['view']['output'] = array(
                    'columns' => array(),
                );
            }
            foreach ($columns as $column) {
                $data['view']['output']['columns'][] = array(
                    'id' => $column['id'],
                    'title' => $column['title'],
                );
            }
        }

        $restriction = $view->getRestriction();
        if ($restriction) {
            $data['view']['restriction'] = array(
                'type' => $restriction->getType(),
                'id' => $restriction->getId(),
            );
        }

        if (empty($data['view']['any'])) {
            unset($data['view']['any']);
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