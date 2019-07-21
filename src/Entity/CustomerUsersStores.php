<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\GetCustomerUsersStoresDriversController;
use App\Controller\GetCustomerUsersStoresDriverController;


/**
 * CustomerUsersStores
 *
 * @ORM\Table(name="customer_users_stores", indexes={@ORM\Index(name="IDX_D4AF3145F3A7C921", columns={"id_stores"}), @ORM\Index(name="IDX_D4AF3145E7D06DD4", columns={"id_customer_users"}), @ORM\Index(name="IDX_D4AF31455534D89D", columns={"id_user_store_position"})})
 * @ORM\Entity
 * @ApiResource(
 *       collectionOperations={
 *           "get",
 *           "get_customer_users_stores_drivers"={
 *              "method"="GET",
 *              "path"="/customer/user/store/{idStores}/drivers/{idDriverStatus}",
 *              "controller"=GetCustomerUsersStoresDriversController::class
 *           },
 *           "get_customer_users_stores_driver"={
 *              "method"="GET",
 *              "path"="/customer/user/store/driver/{id}",
 *              "controller"=GetCustomerUsersStoresDriverController::class
 *           }
 *       },
 *       attributes={"pagination_enabled"=false}
 * )
 */
class CustomerUsersStores
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="customer_users_stores_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     */
    private $updatedDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     */
    private $createdDate;

    /**
     * @var \Stores
     *
     * @ORM\ManyToOne(targetEntity="Stores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_stores", referencedColumnName="id")
     * })
     */
    private $idStores;

    /**
     * @var \CustomerUsers
     *
     * @ORM\ManyToOne(targetEntity="CustomerUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_customer_users", referencedColumnName="id")
     * })
     */
    private $idCustomerUsers;

    /**
     * @var \UserStorePosition
     *
     * @ORM\ManyToOne(targetEntity="UserStorePosition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_store_position", referencedColumnName="id")
     * })
     */
    private $idUserStorePosition;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUpdatedDate(): ?\DateTimeInterface
    {
        return $this->updatedDate;
    }

    public function setUpdatedDate(?\DateTimeInterface $updatedDate): self
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(?\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getIdStores(): ?Stores
    {
        return $this->idStores;
    }

    public function setIdStores(?Stores $idStores): self
    {
        $this->idStores = $idStores;

        return $this;
    }

    public function getIdCustomerUsers(): ?CustomerUsers
    {
        return $this->idCustomerUsers;
    }

    public function setIdCustomerUsers(?CustomerUsers $idCustomerUsers): self
    {
        $this->idCustomerUsers = $idCustomerUsers;

        return $this;
    }

    public function getIdUserStorePosition(): ?UserStorePosition
    {
        return $this->idUserStorePosition;
    }

    public function setIdUserStorePosition(?UserStorePosition $idUserStorePosition): self
    {
        $this->idUserStorePosition = $idUserStorePosition;

        return $this;
    }


}
