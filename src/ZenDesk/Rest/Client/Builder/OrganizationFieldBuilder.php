<?php

namespace ZenDesk\Rest\Client\Builder;

use RestRemoteObject\Client\Rest\Context;
use RestRemoteObject\Client\Rest\Builder\AbstractBuilder;

class OrganizationFieldBuilder extends AbstractBuilder
{
    protected $relatedClass = 'ZenDesk\Service\Remote\OrganizationFieldServiceInterface';

    public function persist(Context $context)
    {
        $params = $context->getResourceBinder()->getParams();
        /** @var \ZenDesk\Entity\OrganizationField $organizationField */
        $organizationField = $params[0];

        $type = $organizationField->getType();
        $data = array(
            'organization_field' => array(
                'type' => $type,
                'title' => $organizationField->getTitle(),
                'key' => $organizationField->getKey(),
                'description' => $organizationField->getDescription(),
                'position' => $organizationField->getPosition(),
                'active' => $organizationField->getActive(),
                'regexp_for_validation' => $organizationField->getRegexpForValidation(),
                'tag' => $organizationField->getTag(),
            ),
        );

        if ($type == 'tagger') {
            $data['organization_field']['custom_field_options'] = $organizationField->getCustomFieldOptions();
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