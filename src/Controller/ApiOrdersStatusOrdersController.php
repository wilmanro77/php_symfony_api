<?php

namespace App\Controller;

use App\Entity\OrdersStatusOrders;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;


class ApiOrdersStatusOrdersController extends AbstractController
{
    private $mailer;
    private $driverLocation;

    public function __construct(\Swift_Mailer $mailer, ApiDriversLocationsController $driverLocation){
        $this->mailer = $mailer;
        $this->driverLocation = $driverLocation;
    }

    public function handle($order){
        $date = new \DateTime(date("Y-m-d H:i:s"));
        $em = $this->getDoctrine()->getManager();
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $lat = $order->getIdOrders()->getIdAddressesPickup()->getIdAddresses()->getLat();
        $lng = $order->getIdOrders()->getIdAddressesPickup()->getIdAddresses()->getLng();
        $em->persist($order);
        $em->flush();
        $response = $this->driverLocation->getNearestDriver($lat, $lng, $order, $date);
        return $response;
    }
        
}
