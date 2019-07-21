<?php
// api/src/Controller/CustomersInitController.php

namespace App\Controller;

use App\Entity\Drivers;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;


class PutDriversController
{
    private $users;
    private $request;

    public function __construct(ApiDriversController $users, RequestStack $request)
    {
        $this->users = $users;
        $this->request = $request;
    }

    /**
     * @Route(
     *     name="put_drivers",
     *     path="/drivers/{id}",
     *     methods={"PUT"},
     *     defaults={
     *         "_api_item_operation_name"="_drivers"
     *     }
     * )
     */
    public function __invoke($id, Drivers $data): JsonResponse
    {
        return $this->users->update($id, $data, $this->request->getCurrentRequest());
    }
}