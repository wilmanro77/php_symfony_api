<?php

namespace App\Controller;

use App\Entity\CustomerUsers;
use App\Entity\Customers;
use App\Entity\CustomerUsersStores;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use \Twilio\Rest\Client;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ApiCutomerUsersController extends AbstractController
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }


    public function handle($userp){    
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(CustomerUsers::class);
    
        if($userp->getEmail()){
            $custm = $repository->findOneBy(['email' => $userp->getEmail()]);
            if ($custm) {
                return new JsonResponse("Email Already Exits");
            }
        }

        //$customer = new Customers();
        //$customer->setName($userp->getName().' '.$userp->getLastname());
        //$em->persist($customer);
        $user = new CustomerUsers();
        $user->setName($userp->getName());
        $user->setLastname($userp->getLastname());
        $user->setEmail($userp->getEmail());
        $user->setPassword($this->encoder->encodePassword($user, $userp->getPassword()));
        $user->setCreatedDate(new \DateTime());
        //$user->setIdCustomers($customer);
        $em->persist($user);
        $em->flush();
        return new JsonResponse(["created"=>true]);

    }



    public function getStores($id){    
        $em = $this->getDoctrine()->getManager();
        $userStores = $em->getRepository(CustomerUsersStores::class)->findBy(["idCustomerUsers" => $id]);
        $stores = [];
        foreach ($userStores as &$userStore) {
            $stores[] = [
                "id"=>$userStore->getIdStores()->getId(),
                "name"=>$userStore->getIdStores()->getName(),
                "address"=>$userStore->getIdStores()->getIdAddresses()->getAddress(),
                "address_id"=>$userStore->getIdStores()->getIdAddresses()->getId(),
                "lat"=>$userStore->getIdStores()->getIdAddresses()->getLat(),
                "lng"=>$userStore->getIdStores()->getIdAddresses()->getLng()
            ];
        }
        return new JsonResponse($stores);

    }
        
}
