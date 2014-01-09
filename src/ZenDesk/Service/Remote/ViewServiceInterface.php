<?php

namespace ZenDesk\Service\Remote;

use ZenDesk\Entity\View;

interface ViewServiceInterface
{
    /**
     * @rest\http POST
     * @rest\uri /views
     * @param View $view
     * @return \ZenDesk\Entity\View
     */
    public function persist(View $view);

    /**
     * @rest\http PUT
     * @rest\uri /views/%view
     * @param View $view
     * @return \ZenDesk\Entity\View
     */
    public function save(View $view);

    /**
     * @rest\http DELETE
     * @rest\uri /views/%view
     * @param View $view
     */
    public function delete(View $view);

    /**
     * @rest\http GET
     * @rest\uri /views/%view/tickets
     * @param View $view
     * @return \ZenDesk\Entity\View[]
     */
    public function getTickets(View $view);

    /**
     * @rest\http GET
     * @rest\uri /views/%id
     * @param int $id
     * @return \ZenDesk\Entity\View
     */
    public function get($id);

    /**
     * @rest\http GET
     * @rest\uri /views
     * @return \ZenDesk\Entity\View[]
     */
    public function getAll();

    /**
     * @rest\http GET
     * @rest\uri /views/active
     * @return \ZenDesk\Entity\View[]
     */
    public function getAllActive();
}