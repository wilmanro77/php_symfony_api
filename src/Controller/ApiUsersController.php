<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Companies;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use \Twilio\Rest\Client;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ApiUsersController extends AbstractController
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }


    public function handle($userp){    
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Users::class);
    
        if($userp->getEmail()){
            $custm = $repository->findOneBy(['email' => $userp->getEmail()]);
            if ($custm) {
                return new JsonResponse("Email Already Exits");
            }
        }
        $userp->setPassword($this->encoder->encodePassword($userp, $userp->getPassword()));
        $em->persist($userp);
        $em->flush();
        return new JsonResponse(["created"=>$userp->getId()]);

    }
        
}
