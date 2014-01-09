<?php

namespace ZenDesk\Service\Remote;

use ZenDesk\Entity\Trigger;

interface TriggerServiceInterface
{
    /**
     * @rest\http POST
     * @rest\uri /triggers
     * @param Trigger $trigger
     * @return \ZenDesk\Entity\Trigger
     */
    public function persist(Trigger $trigger);

    /**
     * @rest\http PUT
     * @rest\uri /triggers/%hook
     * @param Trigger $trigger
     * @return \ZenDesk\Entity\Trigger
     */
    public function save(Trigger $trigger);

    /**
     * @rest\http DELETE
     * @rest\uri /triggers/%hook
     * @param Trigger $trigger
     */
    public function delete(Trigger $trigger);

    /**
     * @rest\http GET
     * @rest\uri /triggers/%id
     * @param int $id
     * @return \ZenDesk\Entity\Trigger
     */
    public function get($id);

    /**
     * @rest\http GET
     * @rest\uri /triggers
     * @return \ZenDesk\Entity\Trigger[]
     */
    public function getAll();
}