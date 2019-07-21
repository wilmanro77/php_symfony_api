<?php
// api/src/Controller/PostDriversLocationsController.php

namespace App\Controller;

use App\Entity\DriversLocations;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class PostDriversLocationsController
{
    private $customerUsers;

    public function __construct(ApiDriversLocationsController $customerUsers)
    {
        $this->customerUsers = $customerUsers;
    }

    /**
     * @Route(
     *     name="post_drivers_locations",
     *     path="/driver/setlocation",
     *     methods={"POST"},
     *     defaults={
     *         "_api_item_operation_name"="_drivers_locations"
     *     }
     * )
     */
    public function __invoke(DriversLocations $data): JsonResponse
    {
        return $this->customerUsers->handle($data);
    }
}