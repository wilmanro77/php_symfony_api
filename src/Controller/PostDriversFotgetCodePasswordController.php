<?php
// api/src/Controller/PostDriversFotgetCodePasswordController.php

namespace App\Controller;

use App\Entity\Drivers;
use App\Entity\DriverForgetPassword;
use App\Entity\VerificationCodeDriver;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PostDriversFotgetCodePasswordController extends AbstractController
{
    

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
    public function __invoke(DriverForgetPassword $data): JsonResponse
    {
        return $this->handle($data);
    }

    public function handle($data){
        $em = $this->getDoctrine()->getManager();
        $driver = $em->getRepository(Drivers::class)->findOneBy(["email" => $data->getEmail()]);
        $verification = $em->getRepository(VerificationCodeDriver::class)->findOneBy(["code" => $data->getCode(), "idDrivers" => $driver ? $driver->getId() : 0]);
        $date = new \DateTime(date("Y-m-d H:i:s"));
        if($driver && $verification) {
            $interval = $date->diff($verification->getCreatedDate());
            if ((int)$interval->format('%i') <= 1) {
                return new JsonResponse(["code" => 200,"message" => "OK"]);
            } else {
                return new JsonResponse(["code" => 408,"message" => "Timeout"], 408);
            }
        } else {
            return new JsonResponse(["code" => 401, "message" => "Bad credentials"], 401);
        }
        
    }


    



}