<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Addresses
 *
 * @ORM\Table(name="addresses", indexes={@ORM\Index(name="IDX_6FCA751617F5C2A0", columns={"id_states"})})
 * @ORM\Entity
 * @ApiResource(attributes={"pagination_enabled"=false, "normalization_context"={"groups"={"address"}}})
 */
class Addresses
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="addresses_id_seq", allocationSize=1, initialValue=1)
     * @Groups({"address"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=128, nullable=true)
     * @Groups({"address","order_driver", "order_status_order"})
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="apto", type="string", length=64, nullable=true)
     * @Groups({"address","order_driver", "order_status_order"})
     */
    private $apto;

    /**
     * @var int|null
     *
     * @ORM\Column(name="zipcode", type="decimal", precision=12, scale=0, nullable=true)
     * @Groups({"address"})
     */
    private $zipcode;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"address"})
     */
    private $updatedDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     * @Groups({"address"})
     */
    private $createdDate;


    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=128, nullable=true)
     * @Groups({"address"})
     */
    private $city;



    /**
     * @var float|null
     *
     * @ORM\Column(name="lat", type="float", precision=10, scale=0, nullable=true)
     * @Groups({"address","order_driver", "order_status_order"})
     */
    private $lat;

    /**
     * @var float|null
     *
     * @ORM\Column(name="lng", type="float", precision=10, scale=0, nullable=true)
     * @Groups({"address","order_driver", "order_status_order"})
     */
    private $lng;


    /**
     * @var string|null
     *
     * @ORM\Column(name="geom", type="geometry")
     */
    private $geom;

    /**
     * @var \States
     *
     * @ORM\ManyToOne(targetEntity="States")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_states", referencedColumnName="id")
     * })
     * @Groups({"address"})
     */
    private $idStates;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getApto(): ?string
    {
        return $this->apto;
    }

    public function setApto(?string $apto): self
    {
        $this->apto = $apto;

        return $this;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function setZipcode($zipcode): self
    {
        $this->zipcode = $zipcode;

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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(?float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getGeom()
    {
        return $this->geom;
    }

    public function setGeom($geom): self
    {
        $this->geom = 'SRID=4326;POINT('.$this->lng.' '.$this->lat.')';
        return $this;
    }

    public function getIdStates(): ?States
    {
        return $this->idStates;
    }

    public function setIdStates(?States $idStates): self
    {
        $this->idStates = $idStates;

        return $this;
    }


}
