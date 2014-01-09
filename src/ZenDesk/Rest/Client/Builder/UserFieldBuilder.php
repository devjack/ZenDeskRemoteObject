<?php

namespace ZenDesk\Rest\Client\Builder;

use RestRemoteObject\Client\Rest\Context;
use RestRemoteObject\Client\Rest\Builder\AbstractBuilder;

class UserFieldBuilder extends AbstractBuilder
{
    protected $relatedClass = 'ZenDesk\Service\Remote\UserFieldServiceInterface';

    public function persist(Context $context)
    {
        $params = $context->getResourceBinder()->getParams();
        /** @var \ZenDesk\Entity\UserField $userField */
        $userField = $params[0];

        $type = $userField->getType();
        $data = array(
            'user_field' => array(
                'type' => $type,
                'title' => $userField->getTitle(),
                'key' => $userField->getKey(),
                'description' => $userField->getDescription(),
                'position' => $userField->getPosition(),
                'active' => $userField->getActive(),
                'regexp_for_validation' => $userField->getRegexpForValidation(),
                'tag' => $userField->getTag(),
            ),
        );

        if ($type == 'tagger') {
            $data['user_field']['custom_field_options'] = $userField->getCustomFieldOptions();
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