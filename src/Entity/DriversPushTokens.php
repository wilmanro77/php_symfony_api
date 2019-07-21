<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * DriversPushTokens
 *
 * @ORM\Table(name="drivers_push_tokens", indexes={@ORM\Index(name="IDX_D3FA80A18A39B681", columns={"id_app_os"}), @ORM\Index(name="IDX_D3FA80A13A8D6A77", columns={"id_drivers"}), @ORM\Index(name="IDX_D3FA80A17EA1F629", columns={"id_push_token_status"})})
 * @ORM\Entity
 * @ApiResource(
 *      collectionOperations={
 *          "get",
 *           "post"={
 *              "path"="/drivers/push/tokens"
 *          }
 *      },
 *      itemOperations={
 *          "get"={"path"="/drivers/push/tokens/{id}"},
 *          "delete",
 *          "put"={
 *              "path"="/drivers/push/tokens/{id}"
 *          }
 *      },
 *      attributes={
 *          "pagination_enabled"=false,
 *          "normalization_context"={
 *               "groups"={"DriversPushToken"}},
 *          "denormalization_context"={
 *              "groups"={"DriversPushToken"}}
 *       }
 *   )
 */
class DriversPushTokens
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="drivers_push_tokens_id_seq", allocationSize=1, initialValue=1)
     * @Groups({"DriversPushToken"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=1024, nullable=false)
     * @Groups({"DriversPushToken"})
     */
    private $token;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     * @Groups({"DriversPushToken"})
     */
    private $createdDate;


    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"DriversPushToken"})
     */
    private $updatedDate;

    /**
     * @var \AppOs
     *
     * @ORM\ManyToOne(targetEntity="AppOs",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_app_os", referencedColumnName="id")
     * })
     * @Groups({"DriversPushToken"})
     */
    private $idAppOs;

    /**
     * @var \Drivers
     *
     * @ORM\ManyToOne(targetEntity="Drivers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_drivers", referencedColumnName="id")
     * })
     * @Groups({"DriversPushToken"})
     */
    private $idDrivers;

    /**
     * @var \PushTokenStatus
     *
     * @ORM\ManyToOne(targetEntity="PushTokenStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_push_token_status", referencedColumnName="id", nullable=true)
     * })
     * @Groups({"DriversPushToken"})
     */
    private $idPushTokenStatus;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function __toString()
{
    return $this->idDrivers;
}

    public function getToken(): ?string
    {
        return $this->token;
    }
    
    public function setToken(string $token): self
    {
        $this->token = $token;

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

    public function getIdAppOs(): ?AppOs
    {
        return $this->idAppOs;
    }

    public function setIdAppOs(?AppOs $idAppOs): self
    {
        $this->idAppOs = $idAppOs;

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

    public function getIdPushTokenStatus(): ?PushTokenStatus
    {
        return $this->idPushTokenStatus;
    }

    public function setIdPushTokenStatus(?PushTokenStatus $idPushTokenStatus): self
    {
        $this->idPushTokenStatus = $idPushTokenStatus;

        return $this;
    }


}
