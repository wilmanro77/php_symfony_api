<?php
// api/src/Controller/CustomersInitController.php

namespace App\Controller;

use App\Entity\Drivers;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class PostDriversController
{
    private $users;

    public function __construct(ApiDriversController $users)
    {
        $this->users = $users;
    }

    /**
     * @Route(
     *     name="post_drivers",
     *     path="/drivers",
     *     methods={"POST"},
     *     defaults={
     *         "_api_item_operation_name"="_drivers"
     *     }
     * )
     */
    public function __invoke(Drivers $data): JsonResponse
    {
        return $this->users->handle($data);
    }
}