<?php
// api/src/Controller/CustomersInitController.php

namespace App\Controller;

use App\Entity\DriversLocations;
use App\Service\AppleSignatureGenerator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;

use Apple\ApnPush\Jwt\Jwt;
use Apple\ApnPush\Protocol\Http\Authenticator\JwtAuthenticator;
use Apple\ApnPush\Jwt\SignatureGenerator;
use Apple\ApnPush\Model\Notification;
use Apple\ApnPush\Model\DeviceToken;
use Apple\ApnPush\Model\Receiver;

use Apple\ApnPush\Certificate\Certificate;
use Apple\ApnPush\Protocol\Http\Authenticator\CertificateAuthenticator;
use Apple\ApnPush\Sender\Builder\Http20Builder;
use Apple\ApnPush\Sender\Sender;



class GetDriversLocationsController extends AbstractController
{
    private $customerUsers;
    private $request;

    public function __construct(ApiDriversLocationsController $customerUsers, RequestStack $request)
    {
        $this->customerUsers = $customerUsers;
        $this->request = $request;
    }

    /**
     * @Route(
     *     name="get_drivers_near",
     *     path="/drivers/near",
     *     methods={"GET"},
     *     defaults={
     *         "_api_item_operation_name"="_drivers_near"
     *     }
     * )
     */
    public function __invoke(): JsonResponse
    {
        $req = $this->request->getCurrentRequest(); 
        return $this->getNearestDriver2($req->get('lat'), $req->get('lng'));
        //return new JsonResponse('askjajks');
    }

    public function getNearestDriver2($lat, $lng){
        $jwt = new Jwt('3KYB9D64M2', '2V44WT9693', '/var/www/backup/AuthKey_2V44WT9693.p8');
        $signGenerator = new AppleSignatureGenerator();
        $authenticator = new JwtAuthenticator($jwt, null, $signGenerator);

        // Build sender
		$builder = new Http20Builder($authenticator);

		$protocol = $builder->buildProtocol();
		$sender = new Sender($protocol);


        $notification = Notification::createWithBody('Hello ;)');
		$receiver = new Receiver(new DeviceToken('06fdb7614fbd785956c50871390f18ace5d04e3e2860a77b905423f5bd84e0eb'), 'Wiro-Technologies.delimsysd1');


		$sender->send($receiver, $notification);



        return new JsonResponse($sender);

    }
}