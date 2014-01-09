<?php

namespace ZenDesk\Service;

use ZenDesk\Entity\View;
use ZenDesk\Service\Remote\ViewServiceInterface;

class ViewService extends AbstractService
{
    /**
     * @param View $view
     */
    public function persist(View $view)
    {
        /** @var ViewServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        $fresh = $remoteService->persist($view);
        $view->refresh($fresh);

        // inject remote service
        $view->setRemoteService($this->getRemoteService());
    }

    /**
     * @param int $id
     * @return \ZenDesk\Entity\View
     */
    public function get($id)
    {
        /** @var ViewServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->get($id);
    }

    /**
     * @return \ZenDesk\Entity\View[]
     */
    public function getAll()
    {
        /** @var ViewServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->getAll();
    }

    /**
     * @return \ZenDesk\Entity\View[]
     */
    public function getAllActive()
    {
        /** @var ViewServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->getAllActive();
    }
}