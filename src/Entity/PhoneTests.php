<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PhoneTests
 *
 * @ORM\Table(name="phone_tests")
 * @ORM\Entity
 * @ApiResource(
 *      attributes={
 *          "pagination_enabled"=false,
 *          "normalization_context"={"groups"={"phone_test"}}
 *      },
 *      collectionOperations={
 *          "get"={
 *              "path"="/phone/tests"
 *          },
 *          "post"={
 *              "path"="/phone/tests"
 *          }
 *      },
 *      itemOperations={
 *          "get"={
 *              "path"="/phone/tests/{id}"
 *          },
 *          "delete"={
 *              "path"="/phone/tests/{id}"
 *          },
 *          "put"={
 *              "path"="/phone/tests/{id}"
 *          }
 *      }
 * )
 */
class PhoneTests
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="phone_tests_id_seq", allocationSize=1, initialValue=1)
     * @Groups({"phone_test"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone_number", type="string", length=20, nullable=true)
     * @Groups({"phone_test"})
     */
    private $phoneNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="os", type="string", length=32, nullable=true)
     * @Groups({"phone_test"})
     */
    private $os;

    /**
     * @var string|null
     *
     * @ORM\Column(name="os_version", type="string", length=32, nullable=true)
     * @Groups({"phone_test"})
     */
    private $osVersion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone_brand", type="string", length=64, nullable=true)
     * @Groups({"phone_test"})
     */
    private $phoneBrand;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone_model", type="string", length=64, nullable=true)
     * @Groups({"phone_test"})
     */
    private $phoneModel;

    /**
     * @var float|null
     *
     * @ORM\Column(name="lat", type="float", precision=10, scale=0, nullable=true)
     * @Groups({"phone_test"})
     */
    private $lat;

    /**
     * @var float|null
     *
     * @ORM\Column(name="lgt", type="float", precision=10, scale=0, nullable=true)
     * @Groups({"phone_test"})
     */
    private $lgt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="geom", type="geometry")
     */
    private $geom;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     * @Groups({"phone_test"})
     */
    private $createdDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"phone_test"})
     */
    private $updatedDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="notification_token", type="string", length=512, nullable=true)
     */
    private $notificationToken;

    /**
     * @var string|null
     *
     * @ORM\Column(name="release", type="string", length=64, nullable=true)
     * @Groups({"phone_test"})
     */
    private $release;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getOs(): ?string
    {
        return $this->os;
    }

    public function setOs(?string $os): self
    {
        $this->os = $os;

        return $this;
    }

    public function getOsVersion(): ?string
    {
        return $this->osVersion;
    }

    public function setOsVersion(?string $osVersion): self
    {
        $this->osVersion = $osVersion;

        return $this;
    }

    public function getPhoneBrand(): ?string
    {
        return $this->phoneBrand;
    }

    public function setPhoneBrand(?string $phoneBrand): self
    {
        $this->phoneBrand = $phoneBrand;

        return $this;
    }

    public function getPhoneModel(): ?string
    {
        return $this->phoneModel;
    }

    public function setPhoneModel(?string $phoneModel): self
    {
        $this->phoneModel = $phoneModel;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLgt(): ?float
    {
        return $this->lgt;
    }

    public function setLgt(?float $lgt): self
    {
        $this->lgt = $lgt;

        return $this;
    }

    public function getGeom()
    {
        return $this->geom;
    }
    public function setGeom($geom): self
    {
        $this->geom = 'SRID=4326;POINT('.$this->lgt.' '.$this->lat.')';
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

    public function getUpdatedDate(): ?\DateTimeInterface
    {
        return $this->updatedDate;
    }

    public function setUpdatedDate(?\DateTimeInterface $updatedDate): self
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    public function getNotificationToken(): ?string
    {
        return $this->notificationToken;
    }

    public function setNotificationToken(?string $notificationToken): self
    {
        $this->notificationToken = $notificationToken;

        return $this;
    }

    public function getRelease(): ?string
    {
        return $this->release;
    }

    public function setRelease(?string $release): self
    {
        $this->release = $release;

        return $this;
    }


}
