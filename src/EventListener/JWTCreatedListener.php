<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTCreatedListener{

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest();
        $user = $event->getUser();
        $current_datetime = getdate();
        $expiration = new \DateTime(($current_datetime["year"]+5)."-".$current_datetime["mon"]."-".$current_datetime["mday"]);
        $expiration->setTime($current_datetime["hours"]+4, $current_datetime["minutes"], $current_datetime["seconds"]);


        $payload       = $event->getData();
        $payload['id'] = $user->getId();
        $payload['ip'] = $request->getClientIp();
        $payload['username'] = $user->getEmail();
        $payload['exp'] = $expiration->getTimestamp();
        



        $event->setData($payload);
        
        //$header        = $event->getHeader();
        //$header['cty'] = 'JWT';

        //$event->setHeader($header);
    }
}