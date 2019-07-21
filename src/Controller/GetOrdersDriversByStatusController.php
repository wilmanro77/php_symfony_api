<?php
// api/src/Controller/CustomersInitController.php

namespace App\Controller;

use App\Entity\OrdersDrivers;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetOrdersDriversByStatusController
{
    private $customerUsers;

    public function __construct(ApiOrdersDriversController $customerUsers)
    {
        $this->customerUsers = $customerUsers;
    }

    /**
     * @Route(
     *     name="get_by_status",
     *     path="/orders/drivers/{idDrivers}/{idOrdersDriversStatus}",
     *     methods={"GET"},
     *     defaults={
     *         "_api_item_operation_name"="_by_status"
     *     }
     * )
     */
    public function __invoke($idDrivers, $idOrdersDriversStatus): JsonResponse
    {
        return $this->customerUsers->handle($idDrivers, $idOrdersDriversStatus);
    }
}