<?php

namespace ZenDesk\Rest\Client\Builder;

use RestRemoteObject\Client\Rest\Context;
use RestRemoteObject\Client\Rest\Builder\AbstractBuilder;

class UserBuilder extends AbstractBuilder
{
    protected $relatedClass = 'ZenDesk\Service\Remote\UserServiceInterface';

    public function persist(Context $context)
    {
        $params = $context->getResourceBinder()->getParams();
        /** @var \ZenDesk\Entity\User $user */
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

    public function suspend(Context $context)
    {
        $data = array(
            'user' => array(
                'suspended' => true,
            ),
        );

        $context
            ->getResourceBinder()
            ->setParams(json_encode($data));
    }
}