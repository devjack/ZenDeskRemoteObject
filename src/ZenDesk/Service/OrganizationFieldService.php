<?php

namespace ZenDesk\Service;

use ZenDesk\Entity\OrganizationField;
use ZenDesk\Service\Remote\OrganizationFieldServiceInterface;

class OrganizationFieldService extends AbstractService
{
    /**
     * @param OrganizationField $organizationField
     */
    public function persist(OrganizationField $organizationField)
    {
        /** @var OrganizationFieldServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        $fresh = $remoteService->persist($organizationField);
        $organizationField->refresh($fresh);

        // inject remote service
        $organizationField->setRemoteService($this->getRemoteService());
    }

    /**
     * @param int $id
     * @return OrganizationField
     */
    public function get($id)
    {
        /** @var OrganizationFieldServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->get($id);
    }

    /**
     * @return \ZenDesk\Entity\OrganizationField[]
     */
    public function getAll()
    {
        /** @var OrganizationFieldServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->getAll();
    }
}