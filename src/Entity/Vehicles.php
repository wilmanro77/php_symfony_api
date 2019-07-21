<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Vehicles
 *
 * @ORM\Table(name="vehicles", indexes={@ORM\Index(name="IDX_1FCE69FAE4897672", columns={"id_colors"}), @ORM\Index(name="IDX_1FCE69FA5F9B0E12", columns={"id_makes"}), @ORM\Index(name="IDX_1FCE69FAC2E185E4", columns={"id_models"}), @ORM\Index(name="IDX_1FCE69FA6A98FAF7", columns={"id_vehicle_kind"})})
 * @ORM\Entity
 * @ApiResource(attributes={"pagination_enabled"=false})
 */
class Vehicles
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="vehicles_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="license", type="string", length=16, nullable=true)
     * @Groups({"vehicle"})
     */
    private $license;

    /**
     * @var string|null
     *
     * @ORM\Column(name="registration_image", type="string", length=128, nullable=true)
     * @Groups({"vehicle"})
     */
    private $registrationImage;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="registration_expires", type="datetime", nullable=true)
     * @Groups({"vehicle"})
     */
    private $registrationExpires;

    /**
     * @var string|null
     *
     * @ORM\Column(name="insurance_image", type="string", length=128, nullable=true)
     * @Groups({"vehicle"})
     */
    private $insuranceImage;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="insurance_expires", type="datetime", nullable=true)
     * @Groups({"vehicle"})
     */
    private $insuranceExpires;

    /**
     * @var int|null
     *
     * @ORM\Column(name="year", type="decimal", precision=4, scale=0, nullable=true)
     * @Groups({"vehicle"})
     */
    private $year;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"vehicle"})
     */
    private $updatedDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     * @Groups({"vehicle"})
     */
    private $createdDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tag", type="string", length=12, nullable=true)
     * @Groups({"vehicle"})
     */
    private $tag;

    /**
     * @var \Colors
     *
     * @ORM\ManyToOne(targetEntity="Colors")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_colors", referencedColumnName="id")
     * })
     * @Groups({"vehicle"})
     */
    private $idColors;

    /**
     * @var \Makes
     *
     * @ORM\ManyToOne(targetEntity="Makes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_makes", referencedColumnName="id")
     * })
     * @Groups({"vehicle"})
     */
    private $idMakes;

    /**
     * @var \Models
     *
     * @ORM\ManyToOne(targetEntity="Models")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_models", referencedColumnName="id")
     * })
     * @Groups({"vehicle"})
     */
    private $idModels;

    /**
     * @var \VehicleKind
     *
     * @ORM\ManyToOne(targetEntity="VehicleKind")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_vehicle_kind", referencedColumnName="id")
     * })
     * @Groups({"vehicle"})
     */
    private $idVehicleKind;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Drivers", inversedBy="idVehicles")
     * @ORM\JoinTable(name="drivers_vehicles",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_vehicles", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_drivers", referencedColumnName="id")
     *   }
     * )
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

    public function getLicense(): ?string
    {
        return $this->license;
    }

    public function setLicense(?string $license): self
    {
        $this->license = $license;

        return $this;
    }

    public function getRegistrationImage(): ?string
    {
        return $this->registrationImage;
    }

    public function setRegistrationImage(?string $registrationImage): self
    {
        $this->registrationImage = $registrationImage;

        return $this;
    }

    public function getRegistrationExpires(): ?\DateTimeInterface
    {
        return $this->registrationExpires;
    }

    public function setRegistrationExpires(?\DateTimeInterface $registrationExpires): self
    {
        $this->registrationExpires = $registrationExpires;

        return $this;
    }

    public function getInsuranceImage(): ?string
    {
        return $this->insuranceImage;
    }

    public function setInsuranceImage(?string $insuranceImage): self
    {
        $this->insuranceImage = $insuranceImage;

        return $this;
    }

    public function getInsuranceExpires(): ?\DateTimeInterface
    {
        return $this->insuranceExpires;
    }

    public function setInsuranceExpires(?\DateTimeInterface $insuranceExpires): self
    {
        $this->insuranceExpires = $insuranceExpires;

        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year): self
    {
        $this->year = $year;

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

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(?string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getIdColors(): ?Colors
    {
        return $this->idColors;
    }

    public function setIdColors(?Colors $idColors): self
    {
        $this->idColors = $idColors;

        return $this;
    }

    public function getIdMakes(): ?Makes
    {
        return $this->idMakes;
    }

    public function setIdMakes(?Makes $idMakes): self
    {
        $this->idMakes = $idMakes;

        return $this;
    }

    public function getIdModels(): ?Models
    {
        return $this->idModels;
    }

    public function setIdModels(?Models $idModels): self
    {
        $this->idModels = $idModels;

        return $this;
    }

    public function getIdVehicleKind(): ?VehicleKind
    {
        return $this->idVehicleKind;
    }

    public function setIdVehicleKind(?VehicleKind $idVehicleKind): self
    {
        $this->idVehicleKind = $idVehicleKind;

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
        }

        return $this;
    }

    public function removeIdDriver(Drivers $idDriver): self
    {
        if ($this->idDrivers->contains($idDriver)) {
            $this->idDrivers->removeElement($idDriver);
        }

        return $this;
    }

}
