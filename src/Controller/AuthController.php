<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Customers;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController extends AbstractController
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
       $this->encoder = $encoder;
    }

    public function register(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $username = $request->request->get('_email');
        $password = $request->request->get('_password');
        
        $user = new Customers();
        $user->setEmail($username);
        $user->setPassword($this->encoder->encodePassword($user, $password));
        $em->persist($user);
        $em->flush();
        return new Response(sprintf('Customer %s successfully created', $user->getEmail()));
    }
    public function api()
    {
        return new Response(sprintf('Logged in as'));
    }
}