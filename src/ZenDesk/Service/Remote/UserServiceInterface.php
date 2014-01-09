<?php

namespace ZenDesk\Service\Remote;

use ZenDesk\Entity\User;

interface UserServiceInterface
{
    /**
     * @rest\http POST
     * @rest\uri /users
     * @param User $user
     * @return \ZenDesk\Entity\User
     */
    public function persist(User $user);

    /**
     * @rest\http PUT
     * @rest\uri /users/%user
     * @param User $user
     * @return \ZenDesk\Entity\User
     */
    public function save(User $user);

    /**
     * @rest\http DELETE
     * @rest\uri /users/%user
     * @param User $user
     * @return \ZenDesk\Entity\User
     */
    public function delete(User $user);

    /**
     * @rest\http GET
     * @rest\uri /users/me
     * @return \ZenDesk\Entity\User
     */
    public function me();

    /**
     * @rest\http PUT
     * @rest\uri /users/%user
     * @param User $user
     * @return \ZenDesk\Entity\User
     */
    public function suspend(User $user);

    /**
     * @rest\http GET
     * @rest\uri /users/%id
     * @param int $id
     * @return \ZenDesk\Entity\User
     */
    public function get($id);

    /**
     * @rest\http GET
     * @rest\uri /users
     * @return \ZenDesk\Entity\User[]
     */
    public function getAll();
}