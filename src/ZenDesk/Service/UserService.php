<?php

namespace ZenDesk\Service;

use ZenDesk\Service\Remote\UserServiceInterface;
use ZenDesk\Entity\User;

class UserService extends AbstractService
{
    /**
     * @param User $user
     */
    public function persist(User $user)
    {
        /** @var UserServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        $fresh = $remoteService->persist($user);
        $user->refresh($fresh);

        // inject remote service
        $user->setRemoteService($this->getRemoteService());
    }

    /**
     * @return \ZenDesk\Entity\User
     */
    public function me()
    {
        /** @var UserServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->me();
    }

    /**
     * @param $id
     * @return \ZenDesk\Entity\User
     */
    public function get($id)
    {
        /** @var UserServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->get($id);
    }

    /**
     * @return \ZenDesk\Entity\User[]
     */
    public function getAll()
    {
        /** @var UserServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->getAll();
    }
}