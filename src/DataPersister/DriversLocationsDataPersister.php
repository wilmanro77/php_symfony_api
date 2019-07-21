<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\DriversLocations;

final class DriversLocationsDataPersister implements DataPersisterInterface
{
    public function supports($data): bool
    {
        return $data instanceof DriversLocations;
    }
    
    public function persist($data)
    {
      // call your persistence layer to save $data
      return "yes";
    }
    
    public function remove($data)
    {
      // call your persistence layer to delete $data
    }
}