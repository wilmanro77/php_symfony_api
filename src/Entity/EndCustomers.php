<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * EndCustomers
 *
 * @ORM\Table(name="end_customers")
 * @ORM\Entity
 * @ApiResource(attributes={"pagination_enabled"=false})
 */
class EndCustomers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="end_customers_id_seq", allocationSize=1, initialValue=1)
     * @Groups({"endCustomers"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=true)
     * @Groups({"endCustomers","order_driver", "order_status_order"})  
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="last_name", type="string", length=128, nullable=true)
     * @Groups({"endCustomers","order_driver", "order_status_order"}) 
     */
    private $lastName;

    /**
     * @var int|null
     *
     * @ORM\Column(name="phone", type="decimal", precision=12, scale=0, nullable=true)
     * @Groups({"endCustomers","order_driver", "order_status_order"}) 
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=128, nullable=true)
     * @Groups({"endCustomers"})
     */
    private $email;

    /**
     * @var int|null
     *
     * @ORM\Column(name="points", type="decimal", precision=12, scale=0, nullable=true)
     * @Groups({"endCustomers"})
     */
    private $points;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"endCustomers"})
     */
    private $updatedDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     * @Groups({"endCustomers"})
     */
    private $createdDate;

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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone): self
    {
        $this->phone = $phone;

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

    public function getPoints()
    {
        return $this->points;
    }

    public function setPoints($points): self
    {
        $this->points = $points;

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


}
