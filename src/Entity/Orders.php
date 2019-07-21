<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Orders 
 *
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="IDX_E52FFDEE4FAB234C", columns={"id_end_customers"}), @ORM\Index(name="IDX_E52FFDEE3A8D6A77", columns={"id_drivers"}), @ORM\Index(name="IDX_E52FFDEEC426A906", columns={"id_addresses_pickup"}), @ORM\Index(name="IDX_E52FFDEE2A354C17", columns={"id_addresses_dropoff"}), @ORM\Index(name="IDX_E52FFDEEF3A7C921", columns={"id_stores"})})
 * @ORM\Entity
 * @ApiResource(
 *      attributes={
 *      "pagination_enabled"=false,
 *      "normalization_context"={
 *          "groups"={
 *              "order",
 *              "store",
 *              "address",
 *              "addressesDropoff",
 *              "addressesPickup",
 *              "endCustomers"
 *          }
 *      },
 *      "denormalization_context"={
 *          "groups"={
 *              "order",
 *              "driver"
 *          }
 *      }
 * })
 * @ApiFilter(DateFilter::class, properties={"createdDate"})
 * @ApiFilter(SearchFilter::class, properties={"idDrivers": "exact"})
 * @ApiFilter(ExistsFilter::class, properties={"idDrivers"})
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="orders_id_seq", allocationSize=1, initialValue=1)
     * @Groups({"order", "order_driver", "order_status_order"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="distance", type="decimal", precision=6, scale=1, nullable=true)
     * @Groups({"order"})
     */
    private $distance;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"order"})
     */
    private $updatedDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     * @Groups({"order"})
     */
    private $createdDate;

    /**
     * @var \EndCustomers
     *
     * @ORM\ManyToOne(targetEntity="EndCustomers", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_end_customers", referencedColumnName="id")
     * })
     * @Groups({"order","order_driver", "order_status_order"})
     */
    private $idEndCustomers;

    /**
     * @var \Drivers
     *
     * @ORM\ManyToOne(targetEntity="Drivers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_drivers", referencedColumnName="id")
     * })
     * @Groups({"order"})
     */
    private $idDrivers;

    /**
     * @var \AddressesPickup
     *
     * @ORM\ManyToOne(targetEntity="AddressesPickup",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_addresses_pickup", referencedColumnName="id")
     * })
     * @Groups({"order", "order_driver", "order_status_order"})
     */
    private $idAddressesPickup;

    /**
     * @var \AddressesDropoff
     *
     * @ORM\ManyToOne(targetEntity="AddressesDropoff", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_addresses_dropoff", referencedColumnName="id")
     * })
     * @Groups({"order","order_driver", "order_status_order"})
     */
    private $idAddressesDropoff;


    /**
     * @var \Stores
     *
     * @ORM\ManyToOne(targetEntity="Stores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_stores", referencedColumnName="id")
     * })
     * @Groups({"order","order_driver", "order_status_order"})
     */
    private $idStores;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrdersStatusOrders", mappedBy="idOrders")
     * @ORM\OrderBy({"createdDate" = "ASC"})
     * @Groups({"order"})
     */
    private $ordersStatusOrders;


     public function __construct()
    {
        $this->ordersStatusOrders = new ArrayCollection();
    }


    /**
     * @return Collection|OrdersStatusOrders[]
     */
    public function getOrdersStatusOrders(): Collection
    {
        return $this->ordersStatusOrders;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistance()
    {
        return $this->distance;
    }

    public function setDistance($distance): self
    {
        $this->distance = $distance;

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

    public function getIdEndCustomers(): ?EndCustomers
    {
        return $this->idEndCustomers;
    }

    public function setIdEndCustomers(?EndCustomers $idEndCustomers): self
    {
        $this->idEndCustomers = $idEndCustomers;

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

    public function getIdAddressesPickup(): ?AddressesPickup
    {
        return $this->idAddressesPickup;
    }

    public function setIdAddressesPickup(?AddressesPickup $idAddressesPickup): self
    {
        $this->idAddressesPickup = $idAddressesPickup;

        return $this;
    }

    public function getIdAddressesDropoff(): ?AddressesDropoff
    {
        return $this->idAddressesDropoff;
    }

    public function setIdAddressesDropoff(?AddressesDropoff $idAddressesDropoff): self
    {
        $this->idAddressesDropoff = $idAddressesDropoff;

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
