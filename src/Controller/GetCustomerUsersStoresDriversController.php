<?php
// api/src/Controller/CustomersInitController.php

namespace App\Controller;

use App\Entity\CustomerUsers;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class GetCustomerUsersStoresDriversController
{
    private $customerUsers;

    public function __construct(ApiCutomerUsersStoresController $customerUsers)
    {
        $this->customerUsers = $customerUsers;
    }

    /**
     * @Route(
     *     name="get_customer_users_stores_drivers",
     *     path="/customer/user/store/{idStores}/drivers/{idDriverStatus}",
     *     methods={"GET"},
     *     defaults={
     *         "_api_item_operation_name"="_customer_users_stores_drivers"
     *     }
     * )
     */
    public function __invoke($idStores, $idDriverStatus): JsonResponse
    {
        sleep(10);
        return $this->customerUsers->getDrivers($idStores, $idDriverStatus);
    }
}