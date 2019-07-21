<?php

namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
// for Doctrine < 2.4: use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Drivers;
use Doctrine\ORM\Events;

class HashPasswordDriversListener implements EventSubscriber
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }
    
    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postUpdate,
        ];
    }
    
        public function postUpdate(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->index($args);
    }
    
    
    public function index(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // perhaps you only want to act on some "Product" entity
        if ($entity instanceof Product) {
            $entityManager = $args->getObjectManager();
            // ... do something with the Product
        }
    }
    
}