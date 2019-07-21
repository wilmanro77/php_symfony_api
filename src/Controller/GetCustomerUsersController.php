<?php
// api/src/Controller/CustomersInitController.php

namespace App\Controller;

use App\Entity\CustomerUsers;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetCustomerUsersController
{
    private $customerUsers;

    public function __construct(ApiCutomerUsersController $customerUsers)
    {
        $this->customerUsers = $customerUsers;
    }

    /**
     * @Route(
     *     name="get_customer_users",
     *     path="/customer/users/stores/{id}",
     *     methods={"GET"},
     *     defaults={
     *         "_api_item_operation_name"="_customer_users"
     *     }
     * )
     */
    public function __invoke($id): JsonResponse
    {
        return $this->customerUsers->getStores($id);
    }
}