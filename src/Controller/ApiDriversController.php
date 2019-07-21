<?php

namespace App\Controller;

use App\Entity\Drivers;
use App\Entity\DriverStatusHistory;
use App\Entity\OrdersDrivers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\RequestStack;


class ApiDriversController extends AbstractController
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }


    public function handle($dvr){    
    	$em = $this->getDoctrine()->getManager();
        $history = new DriverStatusHistory();
        $dvr->getPassword() ? $dvr->setPassword($this->encoder->encodePassword($dvr, $dvr->getPassword())) : null;
        $em->persist($dvr);
        $history->setIdDrivers($dvr);
        $history->setIdDriverStatus($dvr->getIdDriverStatus());
        $history->setCreatedDate($dvr->getCreatedDate());
        $em->persist($history);
        $em->flush();
        return new JsonResponse(["id"=>$dvr->getId()]);
    }


    public function update($id, $dvr, $req){    
        $em = $this->getDoctrine()->getManager();
        $content = json_decode($req->getContent()); 

        foreach ($content as $key => $value) {
            if ($key == 'password' && $value) {
                $dvr->setPassword($this->encoder->encodePassword($dvr, $value));
            }
            elseif($key == 'idDriverStatus') {
                $history = new DriverStatusHistory();
                $history->setIdDrivers($dvr);
                $history->setIdDriverStatus($dvr->getIdDriverStatus());
                $history->setCreatedDate($dvr->getUpdatedDate());
                $em->persist($history);
            }
        }


        $em->persist($dvr);
        $em->flush();
        return new JsonResponse(["updated"=>true]);
    }

    public function getDriversByStatus($idDriverStatus){
        $drivers = [];
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository(Drivers::class)->findBy(["idDriverStatus" => $idDriverStatus > 0 ? $idDriverStatus : [1,2]]);
        foreach ($data as &$driver) {
            $history = $em->getRepository(DriverStatusHistory::class)->findBy(["idDrivers" => $driver->getId()],  array('id' => 'DESC'), 1);
            $drivers[] = [
                'id' => $driver->getId(),
                'name' => $driver->getName(),
                'lastname' => $driver->getLastname(),
                'phone' => $driver->getPhone(),
                'rating' => $driver->getRating(),
                'status' => $driver->getIdDriverStatus()->getName(),
                'oders' => count($em->getRepository(OrdersDrivers::class)->findBy(["idDrivers" => $driver->getId(), "idOrdersDriversStatus" => 2])),
                'date' => count($history) > 0 ? $history[0]->getCreatedDate()->format('Y-m-d H:i:s') : ''
            ];
        }
        return new JsonResponse($drivers);

    }
        
}
