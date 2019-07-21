<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\PostCustomerUsersController;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Controller\GetCustomerUsersController;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * CustomerUsers
 *
 * @ORM\Table(name="customer_users", indexes={@ORM\Index(name="IDX_DAB6D0D2E266F206", columns={"id_customers"})})
 * @ORM\Entity
 * @ApiResource(
 *       collectionOperations={
 *           "get",
 *           "get_customer_users"={
 *              "method"="GET",
 *              "path"="/customer/user/stores/{id}",
 *              "controller"=GetCustomerUsersController::class
 *           },
 *           "post_customer_users"={
 *              "method"="POST",
 *              "path"="/customer_users",
 *              "controller"=PostCustomerUsersController::class
 *          }
 *       },
 *       attributes={"pagination_enabled"=false,
 *       "normalization_context"={"groups"={"customer_user"}},
 *       "denormalization_context"={"groups"={"write"}}}
 * )
 */
class CustomerUsers implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="customer_users_id_seq", allocationSize=1, initialValue=1)
     * @Groups({"customer_user"})
     */
    private $id;


    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=true)
     * @Groups({"customer_user", "write"})
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastname", type="string", length=128, nullable=true)
     * @Groups({"customer_user", "write"})
     */
    private $lastname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=128, nullable=true)
     * @Groups({"customer_user", "write"})
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=512, nullable=true)
     * @Groups({"write"})
     */
    private $password;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"customer_user", "write"})
     */
    private $updatedDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     * @Groups({"customer_user", "write"})
     */
    private $createdDate;

    /**
     * @var \Customers
     *
     * @ORM\ManyToOne(targetEntity="Customers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_customers", referencedColumnName="id")
     * })
     * @Groups({"customer_user", "write"})
     */
    private $idCustomers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getIdCustomers(): ?Customers
    {
        return $this->idCustomers;
    }

    public function setIdCustomers(?Customers $idCustomers): self
    {
        $this->idCustomers = $idCustomers;

        return $this;
    }

     //new


    public function getRoles()
    {
        return array('ROLE_USER');
    }
    public function eraseCredentials()
    {
    }


    public function getSalt()
    {
        return null;
    }


    public function getUsername()
    {
        return null;
    }


}
