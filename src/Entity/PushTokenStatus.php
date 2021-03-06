<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PushTokenStatus
 *
 * @ORM\Table(name="push_token_status")
 * @ORM\Entity
 * @ApiResource(attributes={"pagination_enabled"=false,
 *          "normalization_context"={
 *               "groups"={"DriversPushToken"}},
 *          "denormalization_context"={
 *              "groups"={"DriversPushToken"}}
 *})
 */
class PushTokenStatus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="push_token_status_id_seq", allocationSize=1, initialValue=1)
     * @Groups({"DriversPushToken"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=true)
     * @Groups({"DriversPushToken"})
     */
    private $name;

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


}
