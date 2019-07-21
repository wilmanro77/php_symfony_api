<?php
// api/src/Controller/PostOrdersStatusOrdersController.php

namespace App\Controller;

use App\Entity\OrdersStatusOrders;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class PostOrdersStatusOrdersController
{
    private $oders;

    public function __construct(ApiOrdersStatusOrdersController $oders)
    {
        $this->oders = $oders;
    }

    /**
     * @Route(
     *     name="post_orders_stattus_orders",
     *     path="/orders/status/orders",
     *     methods={"POST"},
     *     defaults={
     *         "_api_item_operation_name"="post_orders_stattus_orders"
     *     }
     * )
     */
    public function __invoke(OrdersStatusOrders $data): JsonResponse
    {
        return $this->oders->handle($data);
    }
}