<?php
// api/src/Controller/CustomersInitController.php

namespace App\Controller;

use App\Entity\OrdersDrivers;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class PutOrdersDriversController
{
    private $odersDrivers;

    public function __construct(ApiOrdersDriversController $odersDrivers)
    {
        $this->odersDrivers = $odersDrivers;
    }

    /**
     * @Route(
     *     name="put_by_driver",
     *     path="/orders/drivers/{id}/{idOrders}",
     *     methods={"PUT"},
     *     defaults={
     *         "_api_item_operation_name"="_by_driver"
     *     }
     * )
     */
    public function __invoke($id, $idOrders, OrdersDrivers $odersDriver): JsonResponse
    {
        return $this->odersDrivers->updateByDriverOrder($id, $idOrders, $odersDriver);
    }
}