<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersUsersRoles
 *
 * @ORM\Table(name="users_users_roles", indexes={@ORM\Index(name="IDX_A6FCB67CFA06E4D9", columns={"id_users"}), @ORM\Index(name="IDX_A6FCB67C495B4779", columns={"id_users_roles"})})
 * @ORM\Entity
 */
class UsersUsersRoles
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="users_users_roles_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_users", referencedColumnName="id")
     * })
     */
    private $idUsers;

    /**
     * @var \UsersRoles
     *
     * @ORM\ManyToOne(targetEntity="UsersRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_users_roles", referencedColumnName="id")
     * })
     */
    private $idUsersRoles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUsers(): ?Users
    {
        return $this->idUsers;
    }

    public function setIdUsers(?Users $idUsers): self
    {
        $this->idUsers = $idUsers;

        return $this;
    }

    public function getIdUsersRoles(): ?UsersRoles
    {
        return $this->idUsersRoles;
    }

    public function setIdUsersRoles(?UsersRoles $idUsersRoles): self
    {
        $this->idUsersRoles = $idUsersRoles;

        return $this;
    }


}
