<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * StoresDrivers
 *
 * @ORM\Table(name="stores_drivers", indexes={@ORM\Index(name="IDX_7FLMN45167F5C2B0", columns={"id_drivers"}), @ORM\Index(name="IDX_9NMD351117F2C2A0", columns={"id_stores"})})
 * @ORM\Entity
 * @ApiResource(attributes={"pagination_enabled"=false})
 */
class StoresDrivers
{


    /**
     * @var \Drivers
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Drivers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_drivers", referencedColumnName="id")
     * })
     */
    private $idDrivers;

    /**
     * @var \States
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Stores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_stores", referencedColumnName="id")
     * })
     * @Groups({"store_driver"})
     */
    private $idStores;


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
     * @Groups({"stores_drivers"})
     */
    private $createdDate;


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

    public function getIdDrivers(): ?Drivers
    {
        return $this->idDrivers;
    }

    public function setIdDrivers(?Drivers $idDrivers): self
    {
        $this->idDrivers = $idDrivers;

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


}
