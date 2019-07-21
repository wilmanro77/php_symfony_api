<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\PostUsersController;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Users
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="IDX_1483A5E9271161D", columns={"id_companies"})})
 * @ORM\Entity
 * @ApiResource(
 *       collectionOperations={
 *           "get",
 *           "post_users"={
 *              "method"="POST",
 *              "path"="/users",
 *              "controller"=PostUsersController::class
 *          }
 *       },
 *       attributes={"pagination_enabled"=false,
 *       "normalization_context"={"groups"={"user"}},
 *       "denormalization_context"={"groups"={"write"}}}
 * )
 */
class Users implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="users_id_seq", allocationSize=1, initialValue=1)
     * @Groups({"user"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=true)
     * @Groups({"user", "write"})
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastname", type="string", length=128, nullable=true)
     * @Groups({"user", "write"})
     */
    private $lastname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=128, nullable=true)
     * @Groups({"user", "write"})
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=528, nullable=true)
     * @Groups({"write"})
     */
    private $password;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"user", "write"})
     */
    private $updatedDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     * @Groups({"user", "write"})
     */
    private $createdDate;

    /**
     * @var \Companies
     *
     * @ORM\ManyToOne(targetEntity="Companies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_companies", referencedColumnName="id")
     * })
     * @Groups({"user", "write"})
     */
    private $idCompanies;

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

    public function getIdCompanies(): ?Companies
    {
        return $this->idCompanies;
    }

    public function setIdCompanies(?Companies $idCompanies): self
    {
        $this->idCompanies = $idCompanies;

        return $this;
    }


    //new


     public function getRoles(){
        return array('ROLE_USER');
    }
    public function eraseCredentials(){
    }


    public function getSalt(){
        return null;
    }


    public function getUsername(){
        return null;
    }


}
