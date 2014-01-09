<?php

namespace ZenDesk\Service\Remote;

use ZenDesk\Entity\OrganizationField;

interface OrganizationFieldServiceInterface
{
    /**
     * @rest\http POST
     * @rest\uri /organization_fields
     * @param OrganizationField $organizationField
     * @return \ZenDesk\Entity\OrganizationField
     */
    public function persist(OrganizationField $organizationField);

    /**
     * @rest\http PUT
     * @rest\uri /organization_fields/%organizationField
     * @param OrganizationField $organizationField
     * @return \ZenDesk\Entity\OrganizationField
     */
    public function save(OrganizationField $organizationField);

    /**
     * @rest\http DELETE
     * @rest\uri /organization_fields/%organizationField
     * @param OrganizationField $organizationField
     */
    public function delete(OrganizationField $organizationField);

    /**
     * @rest\http GET
     * @rest\uri /organization_fields/%id
     * @param int $id
     * @return \ZenDesk\Entity\OrganizationField
     */
    public function get($id);

    /**
     * @rest\http GET
     * @rest\uri /organization_fields
     * @return \ZenDesk\Entity\OrganizationField[]
     */
    public function getAll();
}