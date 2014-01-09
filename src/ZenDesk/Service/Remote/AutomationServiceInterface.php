<?php

namespace ZenDesk\Service\Remote;

use ZenDesk\Entity\Automation;

interface AutomationServiceInterface
{
    /**
     * @rest\http POST
     * @rest\uri /automations
     * @param Automation $automation
     * @return \ZenDesk\Entity\Automation
     */
    public function persist(Automation $automation);

    /**
     * @rest\http PUT
     * @rest\uri /automations/%hook
     * @param Automation $automation
     * @return \ZenDesk\Entity\Automation
     */
    public function save(Automation $automation);

    /**
     * @rest\http DELETE
     * @rest\uri /automations/%hook
     * @param Automation $automation
     */
    public function delete(Automation $automation);

    /**
     * @rest\http GET
     * @rest\uri /automations/%id
     * @param int $id
     * @return \ZenDesk\Entity\Automation
     */
    public function get($id);

    /**
     * @rest\http GET
     * @rest\uri /automations
     * @return \ZenDesk\Entity\Automation[]
     */
    public function getAll();
}