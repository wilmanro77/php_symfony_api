<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Entity\DocidTypes;
use App\Entity\SyCountries;
use App\Entity\SyNeighborhoods;
use App\Entity\SocioeconomicLevels;
use App\Entity\Addresses;
use App\Entity\CustomersAddress;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index", methods="GET")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/login", name="login", methods="GET")
     */
    public function login(): Response
    {
        return $this->render('login.html.twig');
    }
}
