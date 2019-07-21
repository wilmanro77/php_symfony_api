<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\GetOrdersDriversByStatusController;
use App\Controller\PutOrdersDriversController;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * OrdersDrivers
 *
 * @ORM\Table(name="orders_drivers", indexes={@ORM\Index(name="IDX_1565B17C3A8D6A77", columns={"id_drivers"}), @ORM\Index(name="IDX_1565B17C9FCF3080", columns={"id_orders_drivers_status"}), @ORM\Index(name="IDX_1565B17CC3184803", columns={"id_orders"})})
 * @ORM\Entity
 * @ApiResource(
 *      attributes={"pagination_enabled"=false},
 *      collectionOperations={
 *          "get"={
 *              "path"="/orders/drivers"
 *          },
 *          "get_by_status"={
 *              "method"="GET",
 *              "path"="/orders/drivers/{idDrivers}/{idOrdersDriversStatus}",
 *              "controller"=GetOrdersDriversByStatusController::class
 *          },
 *          "post"={
 *              "path"="/orders/drivers"
 *          }
 *      },
 *      itemOperations={
 *          "get"={
 *              "path"="/orders/drivers/{id}"
 *          },
 *          "delete"={
 *              "path"="/orders/drivers/{id}"
 *          },
 *          "put"={
 *              "path"="/orders/drivers/{id}",
 *              "normalization_context"={"groups"={"order_driver"}},
 * *            "denormalization_context"={"groups"={"order_driver"}},
 *          },
 *          "put_by_driver"={
 *              "method"="PUT",
 *              "denormalization_context"={"groups"={"order_driver"}},
 *              "path"="/orders/drivers/{id}/{idOrders}",
 *              "controller"=PutOrdersDriversController::class
 *          }
 *      }
 * )
 */
class OrdersDrivers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="orders_drivers_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"order_driver"})
     */
    private $updatedDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     */
    private $createdDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="distance_secs", type="decimal", precision=7, scale=0, nullable=true)
     */
    private $distanceSecs;

    /**
     * @var string|null
     *
     * @ORM\Column(name="distance_meters", type="decimal", precision=7, scale=1, nullable=true)
     */
    private $distanceMeters;

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
     * @var \OrdersDriversStatus
     *
     * @ORM\ManyToOne(targetEntity="OrdersDriversStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_orders_drivers_status", referencedColumnName="id")
     * })
     * @Groups({"order_driver"})
     */
    private $idOrdersDriversStatus;

    /**
     * @var \Orders
     *
     * @ORM\ManyToOne(targetEntity="Orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_orders", referencedColumnName="id")
     * })
     * @Groups({"order_driver"})
     */
    private $idOrders;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDistanceSecs()
    {
        return $this->distanceSecs;
    }

    public function setDistanceSecs($distanceSecs): self
    {
        $this->distanceSecs = $distanceSecs;

        return $this;
    }

    public function getDistanceMeters()
    {
        return $this->distanceMeters;
    }

    public function setDistanceMeters($distanceMeters): self
    {
        $this->distanceMeters = $distanceMeters;

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

    public function getIdOrdersDriversStatus(): ?OrdersDriversStatus
    {
        return $this->idOrdersDriversStatus;
    }

    public function setIdOrdersDriversStatus(?OrdersDriversStatus $idOrdersDriversStatus): self
    {
        $this->idOrdersDriversStatus = $idOrdersDriversStatus;

        return $this;
    }

    public function getIdOrders(): ?Orders
    {
        return $this->idOrders;
    }

    public function setIdOrders(?Orders $idOrders): self
    {
        $this->idOrders = $idOrders;

        return $this;
    }


}
