<?php
// api/src/Entity/DriversLocations.php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\PostDriversLocationsController;
use App\Controller\GetDriversLocationsController;

    /**
     * @ApiResource(
     *     collectionOperations={
     *         "get",
     *         "get_drivers_near"={
     *              "method"="GET",
     *              "path"="/driver/near",
     *              "controller"=GetDriversLocationsController::class
     *         },
     *         "post_drivers_locations"={
     *              "method"="POST",
     *              "path"="/driver/setlocation",
     *              "controller"=PostDriversLocationsController::class
     *              },
     *     },
     *     itemOperations={},
     *     attributes={
     *         "denormalization_context": {"api_allow_update": true}
     *     }
     *  
     * )
     */
final class DriversLocations
{
    

    /**
     * 
     * @ApiProperty(identifier=true)
     */
    public $id;

    //*************************
    //Customers
    //*************************

    /**
     * @var string|null
     */
    public $idDriver;

    /**
     * @var string|null
     */
    public $lat;

    /**
     * @var string|null
     */
    public $lng;
    
    /**
     * @var string|null
     */
    public $date;


    public function getId()
    {
        return $this->id;
    }


    public function getIdDriver(): ?string
    {
        return $this->idDriver;
    }

    public function setIdDriver(?string $idDriver): self
    {
        $this->idDriver = $idDriver;

        return $this;
    }


    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(?string $lat): self
    {
        $this->lat = $lat;
        return $this;
    }


    public function getLng(): ?string
    {
        return $this->lng;
    }

    public function setLng(?string $lng): self
    {
        $this->lng = $lng;
        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;
        return $this;
    }



}
