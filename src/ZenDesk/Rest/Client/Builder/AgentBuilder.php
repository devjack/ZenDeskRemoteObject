<?php

namespace ZenDesk\Rest\Client\Builder;

use RestRemoteObject\Client\Rest\Context;
use RestRemoteObject\Client\Rest\Builder\AbstractBuilder;

class AgentBuilder extends AbstractBuilder
{
    protected $relatedClass = 'ZenDesk\Service\Remote\AgentServiceInterface';

    public function persist(Context $context)
    {
        $params = $context->getResourceBinder()->getParams();
        /** @var \ZenDesk\Entity\Agent $user */
        $user = $params[0];

        $data = array(
            'user' => array(
                'name' => $user->getName(),
                'time_zone' => $user->getTimeZone(),
                'locale_id' => $user->getLocaleId(),
                'organization_id' => $user->getOrganizationId(),
                'role' => $user->getRole(),
                'verified' => $user->getVerified(),
                'email' => $user->getEmail(),
                'phone' => $user->getPhone(),

                // agent data
                'external_id' => $user->getExternalId(),
                'alias' => $user->getAlias(),
                'signature' => $user->getSignature(),
                'details' => $user->getDetails(),
                'notes' => $user->getNotes(),
                'custom_role_id' => $user->getCustomRoleId(),
                'moderator' => $user->getModerator(),
                //'ticket_restriction' => $user->getTicketRestriction(),
                //'only_private_comments' => $user->getOnlyPrivateComments(),
                'tags' => $user->getTags(),
                'suspended' => $user->getSuspended(),
                //'restricted_agent' => $user->getRestrictedAgent(),
                //'user_fields' => $user->getUserFields(),
            ),
        );

        $context
            ->getResourceBinder()
            ->setParams(json_encode($data));
    }

    public function save(Context $context)
    {
        $this->persist($context);
    }

    public function autocomplete(Context $context)
    {
        $params = $context->getResourceBinder()->getParams();
        $name = $params[0];

        $data['name'] = $name;

        $context
            ->getResourceBinder()
            ->setParams(json_encode($data));
    }
}