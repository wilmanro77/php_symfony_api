<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\PostOrdersStatusOrdersController;

/**
 * OrdersStatusOrders
 *
 * @ORM\Table(name="orders_status_orders", indexes={@ORM\Index(name="IDX_527552479B4E00BB", columns={"id_order_status"}), @ORM\Index(name="IDX_52755247C3184803", columns={"id_orders"})})
 * @ORM\Entity
 * @ApiResource(
 *      attributes={
 *          "pagination_enabled"=false
 *      },
 *      collectionOperations={
 *           "get"={
 *              "path"="/orders/status/orders",
 *              "normalization_context"={"groups"={"order_status_order"}}
 *          },
 *           "post_orders_stattus_orders"={
 *              "method"="POST",
 *              "path"="/orders/status/orders",
 *              "controller"=PostOrdersStatusOrdersController::class,
 *          "normalization_context"={"groups"={"order", "address", "addressesDropoff", "addressesPickup", "endCustomers", "ordersStatusOrders", "orderStatus"}},
 *          "denormalization_context"={"groups"={"order", "address", "addressesDropoff", "addressesPickup", "endCustomers", "ordersStatusOrders", "orderStatus"}}
 *          }
 *      },
 *      itemOperations={
 *          "get"={
 *              "path"="/orders/status/orders/{id}",
 *              "normalization_context"={"groups"={"order_status_order"}}
 *          },
 *          "put"={
 *              "path"="/orders/status/orders/{id}",
 *              "normalization_context"={"groups"={"order_status_order"}}
 *          },
 *          "delete"={
 *              "path"="/orders/status/orders/{id}"
 *          }
 *      })
 */
class OrdersStatusOrders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="orders_status_orders_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"ordersStatusOrders", "order_status_order"})
     */
    private $updatedDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     * @Groups({"ordersStatusOrders", "order_status_order"})
     */
    private $createdDate;

    /**
     * @var \OrderStatus
     *
     * @ORM\ManyToOne(targetEntity="OrderStatus",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_order_status", referencedColumnName="id")
     * })
     * @Groups({"ordersStatusOrders", "order_status_order"})
     */
    private $idOrderStatus;

    /**
     * @var \Orders
     *
     * @ORM\ManyToOne(targetEntity="Orders",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_orders", referencedColumnName="id")
     * })
     * @Groups({"ordersStatusOrders", "order_status_order"})
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

    public function getIdOrderStatus(): ?OrderStatus
    {
        return $this->idOrderStatus;
    }

    public function setIdOrderStatus(?OrderStatus $idOrderStatus): self
    {
        $this->idOrderStatus = $idOrderStatus;

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
