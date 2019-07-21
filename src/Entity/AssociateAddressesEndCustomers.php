<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * AssociateAddressesEndCustomers
 *
 * @ORM\Table(name="associate_addresses_end_customers", indexes={@ORM\Index(name="IDX_85C5B9BA4FAB234C", columns={"id_end_customers"}), @ORM\Index(name="IDX_85C5B9BAEFFFC931", columns={"id_addresses"})})
 * @ORM\Entity
 * @ApiResource(
 *      attributes={
 *          "pagination_enabled"=false,
 *          "denormalization_context"={"groups"={"associateAddressesEndCustomers", "endCustomers", "address"}},
 *          "normalization_context"={"groups"={"associateAddressesEndCustomers", "endCustomers", "address"}}
 *      },
 *       collectionOperations={
 *           "get",
 *           "post"={
 *              "path"="/associate/addresses/end/customers",
 *          }
 *       },
 *   )
 */
class AssociateAddressesEndCustomers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="associate_addresses_end_customers_id_seq", allocationSize=1, initialValue=1)
     * @Groups({"associateAddressesEndCustomers"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="alias", type="string", length=128, nullable=true)
     * @Groups({"associateAddressesEndCustomers"})
     */
    private $alias;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"associateAddressesEndCustomers"})
     */
    private $updatedDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     * @Groups({"associateAddressesEndCustomers"})
     */
    private $createdDate;

    /**
     * @var \EndCustomers
     *
     * @ORM\ManyToOne(targetEntity="EndCustomers",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_end_customers", referencedColumnName="id")
     * })
     * @Groups({"associateAddressesEndCustomers"})
     */
    private $idEndCustomers;

    /**
     * @var \Addresses
     *
     * @ORM\ManyToOne(targetEntity="Addresses",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_addresses", referencedColumnName="id")
     * })
     * @Groups({"associateAddressesEndCustomers"})
     */
    private $idAddresses;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;

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

    public function getIdAddresses(): ?Addresses
    {
        return $this->idAddresses;
    }

    public function setIdAddresses(?Addresses $idAddresses): self
    {
        $this->idAddresses = $idAddresses;

        return $this;
    }


}
