<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Audit
 *
 * @ORM\Table(name="audit", indexes={@ORM\Index(name="IDX_9218FF799B3C6258", columns={"id_apps"})})
 * @ORM\Entity
 * @ApiResource(attributes={"pagination_enabled"=false})
 */
class Audit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="audit_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_user_app", type="integer", nullable=true)
     */
    private $idUserApp;

    /**
     * @var \Apps
     *
     * @ORM\ManyToOne(targetEntity="Apps")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_apps", referencedColumnName="id")
     * })
     */
    private $idApps;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUserApp(): ?int
    {
        return $this->idUserApp;
    }

    public function setIdUserApp(?int $idUserApp): self
    {
        $this->idUserApp = $idUserApp;

        return $this;
    }

    public function getIdApps(): ?Apps
    {
        return $this->idApps;
    }

    public function setIdApps(?Apps $idApps): self
    {
        $this->idApps = $idApps;

        return $this;
    }


}
