<?php

namespace ZenDesk\Service\Remote;

use ZenDesk\Entity\UserField;

interface UserFieldServiceInterface
{
    /**
     * @rest\http POST
     * @rest\uri /user_fields
     * @param UserField $userField
     * @return \ZenDesk\Entity\UserField
     */
    public function persist(UserField $userField);

    /**
     * @rest\http PUT
     * @rest\uri /user_fields/%userField
     * @param UserField $userField
     * @return \ZenDesk\Entity\UserField
     */
    public function save(UserField $userField);

    /**
     * @rest\http DELETE
     * @rest\uri /user_fields/%userField
     * @param UserField $userField
     */
    public function delete(UserField $userField);

    /**
     * @rest\http GET
     * @rest\uri /user_fields/%id
     * @param int $id
     * @return \ZenDesk\Entity\UserField
     */
    public function get($id);

    /**
     * @rest\http GET
     * @rest\uri /user_fields
     * @return \ZenDesk\Entity\UserField[]
     */
    public function getAll();
}