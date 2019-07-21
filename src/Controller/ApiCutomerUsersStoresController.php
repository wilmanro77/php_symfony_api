<?php

namespace App\Controller;

use App\Entity\Drivers;
use App\Entity\StoresDrivers;
use App\Entity\Orders;
use App\Entity\OrdersStatusOrders;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;


class ApiCutomerUsersStoresController extends AbstractController
{

    public function getDrivers($idStores, $idDriverStatus){    
        $em = $this->getDoctrine()->getManager();
        $storesDrivers = $em->getRepository(StoresDrivers::class)->findBy(["idStores" => $idStores]);
        $drivers = [];
        foreach ($storesDrivers as &$storesDriver) {
            $cont = 0;
            if(($storesDriver->getIdDrivers()->getIdDriverStatus()->getId() == $idDriverStatus) || $idDriverStatus == 0){
            $orders = $em->getRepository(Orders::class)->findBy(["idDrivers" => $storesDriver->getIdDrivers()->getId()]);
            foreach ($orders as &$order) {
                $orderStatus = $em->getRepository(OrdersStatusOrders::class)->findBy(["idOrders" => $order->getId(), "idOrderStatus" => 1]);
                if($orderStatus){
                    $cont++;
                }
            }
            $drivers[] = [
                "id" => $storesDriver->getIdDrivers()->getId(),
                "name" => $storesDriver->getIdDrivers()->getName(),
                "last_name" => $storesDriver->getIdDrivers()->getLastname(),
                "avatar" => $storesDriver->getIdDrivers()->getAvatar(),
                "rating" => $storesDriver->getIdDrivers()->getRating(), 
                "orders" => $cont];
            }
        }
        return new JsonResponse($drivers);

    }


    public function getOrders($idDriver){  
        $em = $this->getDoctrine()->getManager();
        $mdate = (new \DateTime())->modify('-1 day');
        $query = $em->createQuery(
            "SELECT o
            FROM App\Entity\Orders o
            WHERE o.idDrivers = :idDriver
            AND o.createdDate >= :mdate"
        )->setParameter('idDriver', $idDriver)->setParameter('mdate', $mdate);
        $result = $query->execute();
        //$result = $em->getRepository(Orders::class)->findBy(["idDrivers" => $idDriver]);
        $orders = [];
        foreach ($result as &$order) {
            $statuses = [];
            $orderStatuses = $order->getOrdersStatusOrders();
            $address = $order->getIdAddressesDropoff() ? $order->getIdAddressesDropoff()->getIdAddresses() : null;
            foreach ($orderStatuses as &$orderStatus) {
                $statuses[] = [
                    "date" => $orderStatus->getCreatedDate(),
                    "name" => $orderStatus->getIdOrderStatus()->getName()
                ];
            }
            $orders[] = [
                "id" => $order->getId(),
                "distance" => $order->getDistance(), 
                "customers_fullname" => $order->getIdEndCustomers() ? $order->getIdEndCustomers()->getName().' '.$order->getIdEndCustomers()->getLastName() : null,
                "address" => $address ? $address->getAddress().', '.$address->getApto().', '.$address->getCity().' '.$address->getZipcode() : null,
                "statuses" => $statuses
            ];

        }
        return new JsonResponse($orders);
    }

        
}
