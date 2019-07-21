<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * DriversVehicles
 *
 * @ORM\Table(name="drivers_vehicles", indexes={@ORM\Index(name="IDX_4B4DC4DD4F15856F", columns={"id_vehicles"})})
 * @ORM\Entity
 * @ApiResource(attributes={"pagination_enabled"=false})
 */
class DriversVehicles
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_drivers", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idDrivers;

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
     * @var \Vehicles
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Vehicles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_vehicles", referencedColumnName="id")
     * })
     * @Groups({"driver_vehicle"})
     */
    private $idVehicles;

    public function getIdDrivers(): ?int
    {
        return $this->idDrivers;
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

    public function getIdVehicles(): ?Vehicles
    {
        return $this->idVehicles;
    }

    public function setIdVehicles(?Vehicles $idVehicles): self
    {
        $this->idVehicles = $idVehicles;

        return $this;
    }


}
