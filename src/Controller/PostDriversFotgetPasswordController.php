<?php
// api/src/Controller/CustomersInitController.php

namespace App\Controller;

use App\Entity\Drivers;
use App\Entity\DriverForgetPassword;
use App\Entity\VerificationCodeDriver;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PostDriversFotgetPasswordController extends AbstractController
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer){
        $this->mailer = $mailer;
    }


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
        $code = $this->generateRandomString();
        $driver = $em->getRepository(Drivers::class)->findOneBy(["email" => $data->getEmail()]);
        if ($driver) {
            $Verification = new VerificationCodeDriver();
            $Verification->setCode($code);
            $Verification->setIdDrivers($driver);
            $Verification->setCreatedDate(new \DateTime($data->getCreatedDate()));
            $em->persist($Verification);
            $em->flush();
            $message = (new \Swift_Message('Delimsys Validation Code'))
                ->setFrom('app.foodthrones@gmail.com')
                ->setTo('yeison.mancilla.0214@gmail.com')
                ->setBody(
                    '<!DOCTYPE html>
                    <html>
                    <body style="font-style: italic;">
                        <h1>Dear member:</h1>
                        <h4 style="display:inline;">Please enter the following code </h4><h2 style="display:inline;color: #F06716;"> '.$code.' </h2><h4 style="display:inline;">to verify your account</h4>
                        <p>Please pay attention: After verification, you will be able to modify your password, login email address and cell phone number. If you did not apply for a verification code, please sign in to your account and change your password to ensure your account\'s security In order to protect your account, please do not allow others access to your email.</p>
                    </body>
                    </html>',
                    'text/html'
            );
            $this->mailer->send($message);
            return new JsonResponse([
                "id" => $driver->getId(),
                "id_verification_code" => $Verification->getId(),
                "code" => $code,
                "date" => $Verification->getCreatedDate()->format('Y-m-d H:i:s')
            ]);
        } else {
            return new JsonResponse(["code" => 401, "message" => "Bad credentials"], 401);
        }
        
    }


    public function generateRandomString(){
        $length = 6;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}