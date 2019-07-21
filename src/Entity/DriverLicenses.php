<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * DriverLicenses
 *
 * @ORM\Table(name="driver_licenses", indexes={@ORM\Index(name="IDX_324591033A8D6A77", columns={"id_drivers"}), @ORM\Index(name="IDX_3245910317F5C2A0", columns={"id_states"})})
 * @ORM\Entity
 * @ApiResource(attributes={"pagination_enabled"=false})
 */
class DriverLicenses
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="driver_licenses_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="identifier", type="string", length=128, nullable=true)
     */
    private $identifier;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="expires", type="datetime", nullable=true)
     */
    private $expires;

    /**
     * @var string|null
     *
     * @ORM\Column(name="class", type="string", length=128, nullable=true)
     */
    private $class;

    /**
     * @var \Drivers
     *
     * @ORM\ManyToOne(targetEntity="Drivers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_drivers", referencedColumnName="id")
     * })
     */
    private $idDrivers;

    /**
     * @var \States
     *
     * @ORM\ManyToOne(targetEntity="States")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_states", referencedColumnName="id")
     * })
     */
    private $idStates;

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

    public function getExpires(): ?\DateTimeInterface
    {
        return $this->expires;
    }

    public function setExpires(?\DateTimeInterface $expires): self
    {
        $this->expires = $expires;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(?string $class): self
    {
        $this->class = $class;

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
