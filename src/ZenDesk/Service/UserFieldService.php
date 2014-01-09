<?php

namespace ZenDesk\Service;

use ZenDesk\Entity\UserField;
use ZenDesk\Service\Remote\UserFieldServiceInterface;

class UserFieldService extends AbstractService
{
    /**
     * @param UserField $userField
     */
    public function persist(UserField $userField)
    {
        /** @var UserFieldServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        $fresh = $remoteService->persist($userField);
        $userField->refresh($fresh);

        // inject remote service
        $userField->setRemoteService($this->getRemoteService());
    }

    /**
     * @param int $id
     * @return UserField
     */
    public function get($id)
    {
        /** @var UserFieldServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->get($id);
    }

    /**
     * @return \ZenDesk\Entity\UserField[]
     */
    public function getAll()
    {
        /** @var UserFieldServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->getAll();
    }
}