<?php
// api/src/DataProvider/SuperCustomersDataProvider.php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Images;
use Doctrine\Common\Persistence\ManagerRegistry;

final class ImagesDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    
    private $itemExtensions;

    public function __construct(ManagerRegistry $managerRegistry)
    {
      $this->managerRegistry = $managerRegistry;
    }
    
    
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        //file_put_contents('./log_'.date("j.n.Y").'.log', "supports-method".PHP_EOL, FILE_APPEND);
        return Images::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Response
    {

        $filename =    "/var/www/delimsys.com/public/images/c4ca4238a0b923820dcc509a6f75849b/".$id;
        // Generate response
        $response = new Response();

        // Set headers
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', 'image');

        //Send headers before outputting anything
        $response->sendHeaders();
        $response->setContent(file_get_contents($filename));
        return $response;


        //$menu = new Menus();
        //$manager = $this->managerRegistry->getManagerForClass(Menus::class);
        //$menu = $manager->getRepository(Menus::class)->find($id);
        //return $menu->getIdGallery();
    }
}
