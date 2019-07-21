<?php

namespace App\Controller;

use App\Entity\OrdersDrivers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;


class ApiOrdersDriversController extends AbstractController
{
    public function handle($idDrivers, $idOrdersDriversStatus){    
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(OrdersDrivers::class);
        $response = null;
        $ordersDrivers = $repository->findBy(['idDrivers' => $idDrivers, 'idOrdersDriversStatus' => $idOrdersDriversStatus]);
        foreach ($ordersDrivers as &$ordersDriver) {
            $order = $ordersDriver->getIdOrders();
            $customer = $order->getIdEndCustomers();
            $pickup = $order->getIdAddressesPickup();
            $dropoof = $order->getIdAddressesDropoff();
            $response[]  = [
                'id' => $order->getId(),
                'distance' => $order->getDistance(),
                'distance_min' => $ordersDriver->getDistanceMin(),
                'distance_miles' => $ordersDriver->getDistanceMiles(),
                'store' => $order->getIdStores() ? [
                                        "id" => $order->getIdStores()->getId(),
                                        "name" => $order->getIdStores()->getName()
                                    ] : null,
                'idEndCustomers' =>  $customer ? ["name" => $customer->getName()] : null,
                'idAddressesPickup' =>  $pickup ? [
                                        "id" => $pickup->getId(),
                                        "alias" => $pickup->getAlias(),
                                        "id_address" => $pickup->getIdAddresses()->getId(),
                                        "address" => $pickup->getIdAddresses()->getAddress(),
                                        "apto" => $pickup->getIdAddresses()->getApto(),
                                        "zipcode" => $pickup->getIdAddresses()->getZipcode(),
                                        "lat" => $pickup->getIdAddresses()->getLat(),
                                        "lng" => $pickup->getIdAddresses()->getLng()
                                    ] : null,
                'idAddressesDropoff' =>  $dropoof ? [
                                        "id" => $dropoof->getId(),
                                        "alias" => $dropoof->getAlias(),
                                        "id_address" => $dropoof->getIdAddresses()->getId(),
                                        "address" => $dropoof->getIdAddresses()->getAddress(),
                                        "apto" => $dropoof->getIdAddresses()->getApto(),
                                        "zipcode" => $dropoof->getIdAddresses()->getZipcode(),
                                        "lat" => $pickup->getIdAddresses()->getLat(),
                                        "lng" => $pickup->getIdAddresses()->getLng()
                                    ] : null,
            ];
        }
        return new JsonResponse($response);
    }

    public function updateByDriverOrder($idDrivers, $idOrders, $odersDriver){
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(OrdersDrivers::class);
        $orderDriver = $repository->findOneBy(['idDrivers' => $idDrivers, 'idOrders' => $idOrders]);
        $response = false;
        if ($orderDriver) {
            $orderDriver->setUpdatedDate($odersDriver->getUpdatedDate());
            $orderDriver->setIdOrdersDriversStatus($odersDriver->getIdOrdersDriversStatus());
            $em->persist($orderDriver);
            $em->flush();
            $response = true;

        }
        return new JsonResponse(['updated' => $response]);
    }
        
}
