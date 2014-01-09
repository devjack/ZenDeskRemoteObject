<?php

namespace ZenDesk\Service\Remote;

use ZenDesk\Entity\Macro;

interface MacroServiceInterface
{
    /**
     * @rest\http POST
     * @rest\uri /macros
     * @param Macro $macro
     * @return \ZenDesk\Entity\Macro
     */
    public function persist(Macro $macro);

    /**
     * @rest\http PUT
     * @rest\uri /macros/%macro
     * @param Macro $macro
     * @return \ZenDesk\Entity\Macro
     */
    public function save(Macro $macro);

    /**
     * @rest\http DELETE
     * @rest\uri /macros/%macro
     * @param Macro $macro
     */
    public function delete(Macro $macro);

    /**
     * @rest\http GET
     * @rest\uri /macros/%id
     * @param int $id
     * @return \ZenDesk\Entity\Macro
     */
    public function get($id);

    /**
     * @rest\http GET
     * @rest\uri /macros
     * @return \ZenDesk\Entity\Macro[]
     */
    public function getAll();
}