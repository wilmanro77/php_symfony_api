<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\PutDriversController;
use App\Controller\PostDriversController;
use App\Controller\GetDriversByStatusController;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * Drivers
 *
 * @ORM\Table(name="drivers", indexes={@ORM\Index(name="IDX_E410C307EFFFC931", columns={"id_addresses"}), @ORM\Index(name="IDX_E410C3078EDC50FB", columns={"id_genres"}), @ORM\Index(name="IDX_E410C307271161D", columns={"id_companies"}), @ORM\Index(name="IDX_E410C30780776AC1", columns={"id_driver_status"})})
 * @ORM\Entity
 * @ApiResource(
 *       collectionOperations={
 *           "get",
 *           "post_drivers"={
 *              "method"="POST",
 *              "path"="/drivers",
 *              "controller"=PostDriversController::class
 *          },
 *           "get_drivers"={
 *              "method"="GET",
 *              "path"="/drivers/status/{idDriverStatus}",
 *              "controller"=GetDriversByStatusController::class
 *          }
 *       },
 *       itemOperations={
 *           "get",
 *           "delete",
 *           "put_drivers"={
 *              "method"="PUT",
 *              "path"="/drivers/{id}",
 *              "controller"=PutDriversController::class
 *          }
 *      },
 *      attributes={
 *          "normalization_context"={
 *               "groups"={
 *                   "DriversPushToken",
 *                   "driver",
 *                   "driverStatus",
 *                   "address",
 *                   "driver_orders",
 *                   "order_driver"
 *               }
 *           },
 *          "denormalization_context"={
 *              "groups"={
 *                       "driver",
 *                       "address",
 *                       "address_pass",
 *                       "store_driver",
 *                       "store",
 *                       "driver_vehicle",
 *                       "vehicle"
 *                   }
 *               }
 *      }
 * )
 * @ApiFilter(SearchFilter::class, properties={"phone": "exact", "idDriverStatus": "exact"})
 */
class Drivers implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="drivers_id_seq", allocationSize=1, initialValue=1)
     * @Groups({"DriversPushToken"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=true)
     * @Groups({"driver"})
     * @Groups({"DriversPushToken"})
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="avatar", type="string", length=256, nullable=true)
     * @Groups({"driver"})
     */
    private $avatar;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastname", type="string", length=128, nullable=true)
     * @Groups({"driver"})
     */
    private $lastname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=128, nullable=true)
     * @Groups({"driver"})
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=128, nullable=true)
     * @Groups({"address_pass"})
     */
    private $password;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dob", type="datetime", nullable=true)
     * @Groups({"driver"})
     */
    private $dob;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"driver"})
     */
    private $updatedDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     * @Groups({"driver"})
     */
    private $createdDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rating", type="decimal", precision=2, scale=1, nullable=true, options={"default"="5.0"})
     * @Groups({"driver"})
     */
    private $rating = '5.0';

    /**
     * @var float|null
     *
     * @ORM\Column(name="last_latitude", type="float", precision=10, scale=0, nullable=true)
     */
    private $lastLatitude;

    /**
     * @var float|null
     *
     * @ORM\Column(name="last_longitude", type="float", precision=10, scale=0, nullable=true)
     */
    private $lastLongitude;


    /**
     * @var string|null
     *
     * @ORM\Column(name="geom", type="geometry")
     */
    private $geom;

    /**
     * @var int|null
     *
     * @ORM\Column(name="personal_identifier", type="decimal", precision=14, scale=0, nullable=true)
     * @Groups({"address"})
     */
    private $personaIdentifier;


    /**
     * @var int|null
     *
     * @ORM\Column(name="phone", type="decimal", precision=14, scale=0, nullable=true)
     * @Groups({"address"})
     */
    private $phone;


    /**
     * @var \Addresses
     *
     * @ORM\ManyToOne(targetEntity="Addresses",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_addresses", referencedColumnName="id")
     * })
     * @Groups({"driver"})
     */
    private $idAddresses;

    /**
     * @var \Genres
     *
     * @ORM\ManyToOne(targetEntity="Genres")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_genres", referencedColumnName="id")
     * })
     * @Groups({"driver"})
     */
    private $idGenres;

    /**
     * @var \Companies
     *
     * @ORM\ManyToOne(targetEntity="Companies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_companies", referencedColumnName="id")
     * })
     * @Groups({"driver"})
     */
    private $idCompanies;

    /**
     * @var \DriverStatus
     *
     * @ORM\ManyToOne(targetEntity="DriverStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_driver_status", referencedColumnName="id")
     * })
     * @Groups("driver")
     */
    private $idDriverStatus;

     /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Vehicles", cascade={"persist"}, mappedBy="idDrivers")
     * @Groups({"driver"})
     */
    private $idVehicles;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Stores", cascade={"persist"}, inversedBy="idDrivers")
     * @ORM\JoinTable(name="stores_drivers",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_drivers", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_stores", referencedColumnName="id")
     *   }
     * )
     * @Groups({"driver"})
     */
    private $idStores;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrdersDrivers", mappedBy="idDrivers")
     * @ORM\OrderBy({"createdDate" = "ASC"})
     * @Groups({"driver_orders"})
     */
    private $ordersDrivers;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ordersDrivers = new ArrayCollection();
        $this->idVehicles = new ArrayCollection();
        $this->idStores = new ArrayCollection();
    }


    /**
     * @return Collection|OrdersDrivers[]
     */
    public function getOrdersDrivers(): Collection
    {
        return $this->ordersDrivers;
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

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(?\DateTimeInterface $dob): self
    {
        $this->dob = $dob;

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

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getLastLatitude(): ?float
    {
        return $this->lastLatitude;
    }

    public function setLastLatitude(?float $lastLatitude): self
    {
        $this->lastLatitude = $lastLatitude;

        return $this;
    }


    public function getLastLongitude(): ?float
    {
        return $this->lastLongitude;
    }

    public function setLastLongitude(?float $lastLongitude): self
    {
        $this->lastLongitude = $lastLongitude;

        return $this;
    }

    public function getGeom()
    {
        return $this->geom;
    }

    public function setGeom($geom): self
    {
        $this->geom = $geom;

        return $this;
    }

    public function getPersonaIdentifier(): ?int
    {
        return $this->personaIdentifier;
    }

    public function setPersonaIdentifier(?int $personaIdentifier): self
    {
        $this->personaIdentifier = $personaIdentifier;

        return $this;
    }


    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

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

    public function getIdGenres(): ?Genres
    {
        return $this->idGenres;
    }

    public function setIdGenres(?Genres $idGenres): self
    {
        $this->idGenres = $idGenres;

        return $this;
    }

    public function getIdCompanies(): ?Companies
    {
        return $this->idCompanies;
    }

    public function setIdCompanies(?Companies $idCompanies): self
    {
        $this->idCompanies = $idCompanies;

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

    /**
     * @return Collection|Vehicles[]
     */
    public function getIdVehicles(): Collection
    {
        return $this->idVehicles;
    }

    public function addIdVehicle(Vehicles $idVehicle): self
    {
        if (!$this->idVehicles->contains($idVehicle)) {
            $this->idVehicles[] = $idVehicle;
            $idVehicle->addIdDriver($this);
        }

        return $this;
    }

    public function removeIdVehicle(Vehicles $idVehicle): self
    {
        if ($this->idVehicles->contains($idVehicle)) {
            $this->idVehicles->removeElement($idVehicle);
            $idVehicle->removeIdDriver($this);
        }

        return $this;
    }

    /**
     * @return Collection|Stores[]
     */
    public function getIdStores(): Collection
    {
        return $this->idStores;
    }

    public function addIdStore(Stores $idStore): self
    {
        if (!$this->idStores->contains($idStore)) {
            $this->idStores[] = $idStore;
        }

        return $this;
    }

    public function removeIdStore(Stores $idStore): self
    {
        if ($this->idStores->contains($idStore)) {
            $this->idStores->removeElement($idStore);
        }

        return $this;
    }


    //new


    public function getRoles(){
        return array('ROLE_USER');
    }
    public function eraseCredentials(){
    }


    public function getSalt(){
        return null;
    }


    public function getUsername(){
        return null;
    }


    public function __toString(){
        // to show the name of the Category in the select
        return $this->name;
        // to show the id of the Category in the select
        // return $this->id;
    }

}
