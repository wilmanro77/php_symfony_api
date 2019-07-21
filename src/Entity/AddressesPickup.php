<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * AddressesPickup
 *
 * @ORM\Table(name="addresses_pickup", indexes={@ORM\Index(name="IDX_27ACFCD7EFFFC931", columns={"id_addresses"})})
 * @ORM\Entity
 * @ApiResource(attributes={"pagination_enabled"=false, "normalization_context"={"groups"={"address", "addressesPickup"}}, "denormalization_context"={"groups"={"address", "addressesPickup"}}})
 */
class AddressesPickup
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="addresses_pickup_id_seq", allocationSize=1, initialValue=1)
     * @Groups({"addressesPickup"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="alias", type="string", length=128, nullable=true)
     * @Groups({"addressesPickup"})
     */
    private $alias;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"addressesPickup"})
     */
    private $updatedDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     * @Groups({"addressesPickup"})
     */
    private $createdDate;

    /**
     * @var \Addresses
     *
     * @ORM\ManyToOne(targetEntity="Addresses", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_addresses", referencedColumnName="id")
     * })
     * @Groups({"addressesPickup" ,"order_driver", "order_status_order"})
     */
    private $idAddresses;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;

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

    public function getIdAddresses(): ?Addresses
    {
        return $this->idAddresses;
    }

    public function setIdAddresses(?Addresses $idAddresses): self
    {
        $this->idAddresses = $idAddresses;

        return $this;
    }


}
