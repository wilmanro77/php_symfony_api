<?php
// api/src/Controller/CustomersInitController.php

namespace App\Controller;

use App\Entity\CustomerUsers;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class PostCustomerUsersController
{
    private $customerUsers;

    public function __construct(ApiCutomerUsersController $customerUsers)
    {
        $this->customerUsers = $customerUsers;
    }

    /**
     * @Route(
     *     name="post_customer_users",
     *     path="/customer_users",
     *     methods={"POST"},
     *     defaults={
     *         "_api_item_operation_name"="_customer_users"
     *     }
     * )
     */
    public function __invoke(CustomerUsers $data): JsonResponse
    {
        return $this->customerUsers->handle($data);
    }
}