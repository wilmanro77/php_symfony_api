<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Stores
 *
 * @ORM\Table(name="stores", uniqueConstraints={@ORM\UniqueConstraint(name="stores_uq", columns={"id_addresses"})}, indexes={@ORM\Index(name="IDX_D5907CCCE266F206", columns={"id_customers"})})
 * @ORM\Entity
 * @ApiResource(attributes={"pagination_enabled"=false})
 */
class Stores
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="stores_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=true)
     * @Groups({"store", "order_status_order"})
     */
    private $name;


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
     * @Groups({"store"})
     */
    private $createdDate;

    /**
     * @var \Customers
     *
     * @ORM\ManyToOne(targetEntity="Customers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_customers", referencedColumnName="id")
     * })
     */
    private $idCustomers;

    /**
     * @var \Addresses
     *
     * @ORM\ManyToOne(targetEntity="Addresses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_addresses", referencedColumnName="id")
     * })
     */
    private $idAddresses;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Drivers", mappedBy="idStores")
     */
    private $idDrivers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idDrivers = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    public function getIdAddresses(): ?Addresses
    {
        return $this->idAddresses;
    }

    public function setIdAddresses(?Addresses $idAddresses): self
    {
        $this->idAddresses = $idAddresses;

        return $this;
    }

    /**
     * @return Collection|Drivers[]
     */
    public function getIdDrivers(): Collection
    {
        return $this->idDrivers;
    }

    public function addIdDriver(Drivers $idDriver): self
    {
        if (!$this->idDrivers->contains($idDriver)) {
            $this->idDrivers[] = $idDriver;
            $idDriver->addIdStore($this);
        }

        return $this;
    }

    public function removeIdDriver(Drivers $idDriver): self
    {
        if ($this->idDrivers->contains($idDriver)) {
            $this->idDrivers->removeElement($idDriver);
            $idDriver->removeIdStore($this);
        }

        return $this;
    }

}
