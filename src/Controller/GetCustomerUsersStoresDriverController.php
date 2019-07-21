<?php
// api/src/Controller/CustomersInitController.php

namespace App\Controller;

use App\Entity\CustomerUsers;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class GetCustomerUsersStoresDriverController
{
    private $customerUsers;

    public function __construct(ApiCutomerUsersStoresController $customerUsers)
    {
        $this->customerUsers = $customerUsers;
    }

    /**
     * @Route(
     *     name="get_customer_users_stores_driver",
     *     path="/customer/user/store/driver/{id}",
     *     methods={"GET"},
     *     defaults={
     *         "_api_item_operation_name"="_customer_users_stores_driver"
     *     }
     * )
     */
    public function __invoke($id): JsonResponse
    {
        return $this->customerUsers->getOrders($id);
        //return new JsonResponse("El numero es: ".$id);
    }
}