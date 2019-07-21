<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * DriversFirebase
 *
 * @ORM\Table(name="drivers_firebase", indexes={@ORM\Index(name="IDX_CFC3A7CE3A8D6A77", columns={"id_drivers"})})
 * @ORM\Entity
 * @ApiResource(attributes={"pagination_enabled"=false})
 */
class DriversFirebase
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="drivers_firebase_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="identifier", type="string", length=1024, nullable=true)
     */
    private $identifier;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     */
    private $createdDate;

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

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

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


}
