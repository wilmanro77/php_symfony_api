<?php
// api/src/Entity/DriverForgetPassword.php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\PostDriversFotgetPasswordController;
use App\Controller\PostDriversFotgetCodePasswordController;

    /**
     * @ApiResource(
     *     collectionOperations={
     *           "post_forget_password"={
     *              "method"="POST",
     *              "path"="/drivers/forget/password",
     *              "controller"=PostDriversFotgetPasswordController::class,
     *              "denormalization_context"={"groups"={"code"}}
     *          },
     *           "post_forget_password_code"={
     *              "method"="POST",
     *              "path"="/drivers/forget/password/code",
     *              "controller"=PostDriversFotgetCodePasswordController::class
     *          }
     *       },
     *     itemOperations={},
     *     attributes={
     *         "denormalization_context": {"api_allow_update": true}
     *     }
     *  
     * )
     */
final class DriverForgetPassword
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
     * @Groups({"code"})
     */
    public $email;

    /**
     * @var string|null
     */
    public $code;

    /**
     * @var string|null
     * @Groups({"code"})
     */
    private $createdDate;


    public function getId()
    {
        return $this->id;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }


    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getCreatedDate(): ?string
    {
        return $this->createdDate;
    }

    public function setCreatedDate(?string $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

}
