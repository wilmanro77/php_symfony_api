<?php
// api/src/Controller/CustomersInitController.php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class PostUsersController
{
    private $users;

    public function __construct(ApiUsersController $users)
    {
        $this->users = $users;
    }

    /**
     * @Route(
     *     name="post_users",
     *     path="/users",
     *     methods={"POST"},
     *     defaults={
     *         "_api_item_operation_name"="_users"
     *     }
     * )
     */
    public function __invoke(Users $data): JsonResponse
    {
        return $this->users->handle($data);
    }
}