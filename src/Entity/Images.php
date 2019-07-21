<?php
// api/src/Entity/SuperCustomers.php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;

    /**
     * @ApiResource(
     *     itemOperations={
     *         "get"={
     *             "path"="/images/{id}"
     *          }
     *       },
     *     attributes={
 	 *         "denormalization_context": {"api_allow_update": true}
     *     }
     *  
     * )
     */
final class Images
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
    public $name;



    public function getId()
    {
        return $this->id;
    }


}
