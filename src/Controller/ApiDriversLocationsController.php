<?php

namespace App\Controller;

use App\Entity\DriversLocations;
use App\Entity\Orders;
use App\Entity\OrdersDrivers;
use App\Entity\OrdersDriversStatus;
use App\Entity\Drivers;
use App\Entity\DriversPushTokens;
use App\Entity\DriversLocationHistory;
use App\Entity\UsersRolePoliciesUsersRoles;
use App\Entity\UsersUsersRoles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

use Apple\ApnPush\Jwt\Jwt;
use Apple\ApnPush\Protocol\Http\Authenticator\JwtAuthenticator;



class ApiDriversLocationsController extends AbstractController
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer){
        $this->mailer = $mailer;
    }



    public function handle($driverLoc){
        $em = $this->getDoctrine()->getManager();
        $driver = $em->getRepository(Drivers::class)->find($driverLoc->getIdDriver());



        if($driver){
            //History
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/../../google-service-account.json');
            $firebase = (new Factory)
                        ->withServiceAccount($serviceAccount)
                        ->withDatabaseUri('https://my-first-app-291da.firebaseio.com')
                        ->create();
            $db = $firebase->getDatabase();
            $driverHistory = new DriversLocationHistory();
            $driverHistory->setGeom('SRID=4326;POINT('.$driverLoc->getLng().' '.$driverLoc->getLat().')');
            $driverHistory->setIdDrivers($driver);
            $driverHistory->setCreatedDate(new \DateTime($driverLoc->getDate()));
            $em->persist($driverHistory);
            //Driver
            $driver->setLastLatitude($driverLoc->getLat());
            $driver->setLastLongitude($driverLoc->getLng());
            $driver->setUpdatedDate(new \DateTime($driverLoc->getDate()));
            $driver->setGeom('SRID=4326;POINT('.$driverLoc->getLng().' '.$driverLoc->getLat().')');
            $em->persist($driver);
            $em->flush();
            $updates = [
                'locations/'.$driver->getId() => ['lat' => $driverLoc->getLat(), 'lng' => $driverLoc->getLng()]
            ];

            $db->getReference() // this is the root reference
               ->update($updates);
            return new JsonResponse("true");
        }
        else{
            return new JsonResponse("false");
        }
        
    }


    public function getNearestDriver2($lat, $lng){
        $jwt = new Jwt('3KYB9D64M2', '2V44WT9693', 'C:\xampp\htdocs\delymsys\config\jwt\AuthKey_2V44WT9693.p8');
        $authenticator = new JwtAuthenticator($jwt);
        return new JsonResponse($authenticator);
    }

    public function getNearestDriver($lat, $lng, $orderStatus, $date){
        if($lng && $lat){
                $em = $this->getDoctrine()->getManager();
            
            $conn = $this->getDoctrine()->getManager()->getConnection();
            $order = $orderStatus->getIdOrders();
            //$order = $em->getRepository(Orders::class)->find(98);
            $dvr = [];
            $dbg = [];
            $dis = [];
            $or1 = '';
            $round = 1;
            $miles = [3 , 5];
            //Consulta
            while ($round <= 2){
                $attempt = 1;
                $exclude = '';
                while ($attempt <= 3) {
                    $origins = '';
                    $drivers = [];
                    $identifiers = [];
                    $orderDriver = null;
                    $message = null;
                    for ($i=0; $i < count($miles) && count($drivers) == 0 ; $i++){ 
                        $sql = "SELECT drivers.id, drivers.name, drivers.lastname, drivers.geom, drivers.last_latitude, drivers.last_longitude, vehicles.tag FROM drivers LEFT JOIN drivers_vehicles ON drivers.id = drivers_vehicles.id_drivers LEFT JOIN vehicles ON vehicles.id = drivers_vehicles.id_vehicles WHERE ST_DWithin(geom, ST_GeomFromText('POINT(".$lng." ".$lat.")',4326), 0.014526438*".$miles[$i].") AND drivers.id_driver_status = 1".$exclude;
                        $stmt = $conn->prepare($sql);
                        $dbg[] = $sql;
                        $stmt->execute();
                        $drivers = $stmt->fetchAll();
                    }
                    if (count($drivers) > 0){
                        //Contruye cadena de origenes
                        foreach ($drivers as &$tmpDriver){
                            if ($origins) {
                                $origins .= '|';
                            }
                            $origins .= $tmpDriver['last_latitude'].','.$tmpDriver['last_longitude'];
                        }
                        //url api google
                        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$origins."&destinations=".$lat.",".$lng."&key=AIzaSyAsaoL9Y7M2mBNx1vhyrurIKECrestCaHc";
                        $dis[] = $url;
                        $driver = $this->getNearestDriverPos($url);
                        //Posición del driver mas cercano en el array
                        $pos = $driver['pos'];
                        $pushTokens = $em->getRepository(DriversPushTokens::class)->findBy(["idDrivers"=>$drivers[$pos]['id']]);
                        foreach ($pushTokens as &$pushToken){
                            $identifiers[] = $pushToken->getToken();
                        }
                        if (count($identifiers)) {
                            $now = new \DateTime(date("Y-m-d H:i:s"));
                            $interval = $date->diff($now);
                            $created = $order->getCreatedDate();
                            $created->add(new \DateInterval('PT'.$interval->format('%i').'M'.$interval->format('%s').'S'));
                            $orderDriver = new OrdersDrivers();
                            $orderDriver->setCreatedDate(new \DateTime());
                            $orderDriver->setIdOrdersDriversStatus($em->getRepository(OrdersDriversStatus::class)->find(1));
                            $orderDriver->setIdDrivers($em->getRepository(Drivers::class)->find($drivers[$pos]['id']));
                            $orderDriver->setIdOrders($order);
                            $orderDriver->setDistanceMeters($driver['distance_value']);
                            $orderDriver->setDistanceSecs($driver['duration_value']);
                            $em->persist($orderDriver);
                            $em->flush();  
                            $data = array(
                                "id_req"=>$orderDriver->getId(),
                                "id_order_status_order"=>$orderStatus->getId(),
                                "distance"=>$driver['duration'].' '.$driver['distance'],
                                    "address"=>$order->getIdAddressesDropoff()->getIdAddresses()->getAddress(),
                                    "title"=>$order->getIdStores()->getName(),
                                "message"=>"Nueva Orden!!",
                                "date"=>$created->format('d-m-Y H:i:s.000'),
                                "lat"=>$lat,
                                "lng"=>$lng          
                            );
                            $message = $this->sendNotification($identifiers, $data);
                            $rmess = $message->failure;
                            if($message->failure != count($identifiers)){
                                sleep(5);
                                $em->detach($orderDriver);
                                $nOrderDriver = $em->getRepository(OrdersDrivers::class)->find($orderDriver->getId());
                                $em->refresh($nOrderDriver);
                                //$ODStatus = $nOrderDriver->getIdOrdersDriversStatus()->getId() ;
                                //$em->refresh($nOrderDriver);
                                //$tmpStatus = $ODStatus;
                                $SqlString = 'SELECT od, ods FROM App\Entity\OrdersDrivers od JOIN od.idOrdersDriversStatus ods where od.id ='.$orderDriver->getId();
                                $query = $em->createQuery($SqlString);
                                $query->setHint(\Doctrine\ORM\Query::HINT_REFRESH, TRUE);
                                $resu = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                                $ODStatus = $resu[0]['idOrdersDriversStatus']['id'];
                                
                                //$ODStatus = 5;
                                if($ODStatus == 5){
                                    $i=0;
                                    for ($i=0; $i < 10 && $ODStatus != 2; $i++) { 
                                        sleep(1);
                                        $resu = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                                        $ODStatus = $resu[0]['idOrdersDriversStatus']['id'];
                                        $nOrderDriver = $em->getRepository(OrdersDrivers::class)->find($orderDriver->getId());
                                        //$em->refresh($nOrderDriver);
                                        $or1 .= $i.'|'.$ODStatus.'-';
                                    }
                                    $or1 .= $i.'|'.$ODStatus.'||';
                                }
                                if ($ODStatus == 2) {
                                    $order->setIdDrivers($em->getRepository(Drivers::class)->find($drivers[$pos]['id']));
                                    //$order->setDistance($distance);
                                    $em->persist($order);
                                    $em->flush();
                                    return new JsonResponse([
                                        "id"=>$drivers[$pos]['id'],
                                        "name"=>$drivers[$pos]['name']." ".$drivers[$pos]['lastname'],
                                        "vehicle_tag"=>$drivers[$pos]['tag'],
                                        "id_order"=>$order->getId(),
                                        "distance"=>$driver['distance'],
                                        "message"=>$message,
                                        "dbg"=> $dbg,
                                        "url" => $dis,
                                        "or1"=> $or1,
                                        "rs1"=>$rmess
                                    ]);
                                }
                                $dvr[$drivers[$pos]['id']] = 'rejected';
                                $orderDriver->setIdOrdersDriversStatus($em->getRepository(OrdersDriversStatus::class)->find(3));
                                $em->persist($orderDriver);
                                $em->flush();
                            }
                        }
                        $exclude .= " AND drivers.id <> ".$drivers[$pos]['id'];
                    }
                    elseif ($round == 1) {
                        $attempt = 3;
                    }
                    $attempt++;
                }
                $round++;
            }
            $title = count($dvr) ? 'The system found ('.count($dvr).') drivers that did not accept the order' : 'There are not drivers near';
            $customer = $order->getIdEndCustomers();
            $address = $order->getIdAddressesDropoff()->getIdAddresses();
            $body = '<!DOCTYPE html>
                <html>
                <body style="font-style: italic;">
                    <p>'.$title.', to the order '.$order->getId().', of '.$customer->getName().' '.$customer->getLastName().' located in the address '.$address->getAddress().', tel '.$order->getIdEndCustomers()->getPhone().'</p>
                </body>
                </html>';
            $emails = $this->sendEmail(1, 'Message Important from Delimsys', $body);
            $response = new JsonResponse();

            $response->setData([
                "id_order"=>$order->getId(),
                "message"=>$title,
                "emails"=>$emails,
                "dbg" => $dbg,
                "url" => $dis,
                "or1"=> $or1,
                "odS"=> $ODStatus
            ]);
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            return $response;
        }
        else{
            $response = new JsonResponse();
            $response->setData([
                'message' => 'falta latitud y longitud'
            ]);
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR );
            return $response;
        }
    }


    public function getNearestDriverPos($url){
        //Peticion APi google
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        //Asigna id_firebase   a cada distancia para reconcerlo despues de ordenarlos
        $pos = 0;
        $near = $response->rows[$pos]->elements[0]->distance->value;
        for ($i=1; $i < count($response->rows); $i++) { 
            if($response->rows[$i]->elements[0]->distance->value < $near){
                $pos = $i;
                $near = $response->rows[$pos]->elements[0]->distance->value;
            }
        }

        $driver = [
            "pos"=>$pos,
            "distance" => $response->rows[$pos]->elements[0]->distance->text,
            "duration" => $response->rows[$pos]->elements[0]->duration->text,
            "distance_value" => $response->rows[$pos]->elements[0]->distance->value,
            "duration_value" => $response->rows[$pos]->elements[0]->duration->value
        ];
        return $driver;
    }


    public function sendNotification($identifiers, $data){
        //Manda Notificación al mas cercano
        $json = array("data"=>$data, "registration_ids"=>$identifiers, "time_to_live" => 3,"sound"=>"default");
        $data_string = json_encode($json);
        $key = "AAAAwFMbNSQ:APA91bEfgiRWDlynhWjGeI8tveWTcWi_Y-wKiFFyW1_KxYqbJ09znx6v9dQGm590fQpkrLWqS-g6oTRD92Ic4-CrVP2gB0Fhu48tBDQUu7j46SNvTa5BlcpnNMA3UAoIa_m7ul0BdyO2";

         $ch = curl_init('https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: key=' . $key
            )
        );
        $message = curl_exec($ch);
        $message = json_decode($message);
        $message->identifiers = count($identifiers);
        curl_close($ch);
        return $message;
    }

    public function sendEmail($idUsersRolePolicies, $title, $body){
        $em = $this->getDoctrine()->getManager();
        $roleIds = [];
        $emails = [];
        $rolePolicies =  $em->getRepository(UsersRolePoliciesUsersRoles::class)->findBy(['idUsersRolePolicies' => $idUsersRolePolicies]);
        foreach ($rolePolicies as &$roles){
            $roleIds[] = $roles->getIdUsersRoles()->getId();
        }
        $userRoles =  $em->getRepository(UsersUsersRoles::class)->findBy(['idUsersRoles' => $roleIds]);
        foreach ($userRoles as &$users){
            $emails[] = $users->getIdUsers()->getEMail();
        }

        $message = (new \Swift_Message($title))
        ->setFrom('app.foodthrones@gmail.com')
        ->setTo($emails)
        ->setBody($body, 'text/html');
        $this->mailer->send($message);
        return $emails;
    }

}
