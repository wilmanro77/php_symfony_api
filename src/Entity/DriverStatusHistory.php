<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * DriverStatusHistory
 *
 * @ORM\Table(name="driver_status_history", indexes={@ORM\Index(name="IDX_BC4EDFDF80776AC1", columns={"id_driver_status"}), @ORM\Index(name="IDX_BC4EDFDF3A8D6A77", columns={"id_drivers"})})
 * @ORM\Entity
 * @ApiResource(attributes={"pagination_enabled"=false})
 */
class DriverStatusHistory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="driver_status_history_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     */
    private $createdDate;

    /**
     * @var \DriverStatus
     *
     * @ORM\ManyToOne(targetEntity="DriverStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_driver_status", referencedColumnName="id")
     * })
     */
    private $idDriverStatus;

    /**
     * @var \Drivers
     *
     * @ORM\ManyToOne(targetEntity="Drivers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_drivers", referencedColumnName="id")
     * })
     */
    private $idDrivers;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdDriverStatus(): ?DriverStatus
    {
        return $this->idDriverStatus;
    }

    public function setIdDriverStatus(?DriverStatus $idDriverStatus): self
    {
        $this->idDriverStatus = $idDriverStatus;

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


}
