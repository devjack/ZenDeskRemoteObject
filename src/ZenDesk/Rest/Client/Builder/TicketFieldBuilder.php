<?php

namespace ZenDesk\Rest\Client\Builder;

use RestRemoteObject\Client\Rest\Context;
use RestRemoteObject\Client\Rest\Builder\AbstractBuilder;

class TicketFieldBuilder extends AbstractBuilder
{
    protected $relatedClass = 'ZenDesk\Service\Remote\TicketFieldServiceInterface';

    public function persist(Context $context)
    {
        $params = $context->getResourceBinder()->getParams();
        /** @var \ZenDesk\Entity\TicketField $ticketField */
        $ticketField = $params[0];

        $type = $ticketField->getType();
        $data = array(
            'ticket_field' => array(
                'type' => $type,
                'title' => $ticketField->getTitle(),
                'description' => $ticketField->getDescription(),
                'position' => $ticketField->getPosition(),
                'active' => $ticketField->getActive(),
                'required' => $ticketField->getRequired(),
                'collapsed_for_agents' => $ticketField->getCollapsedForAgent(),
                'regexp_for_validation' => $ticketField->getRegexpForValidation(),
                'title_in_portal' => $ticketField->getTitleInPortal(),
                'visible_in_portal' => $ticketField->getVisibleInPortal(),
                'editable_in_portal' => $ticketField->getEditableInPortal(),
                'required_in_portal' => $ticketField->getRequiredInPortal(),
                'tag' => $ticketField->getTag(),
            ),
        );

        if ($type == 'tagger') {
            $data['ticket_field']['custom_field_options'] = $ticketField->getCustomFieldOptions();
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