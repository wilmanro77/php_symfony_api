<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersRolePoliciesUsersRoles
 *
 * @ORM\Table(name="users_role_policies_users_roles", indexes={@ORM\Index(name="IDX_E430751B8557CD39", columns={"id_users_role_policies"}), @ORM\Index(name="IDX_E430751B495B4779", columns={"id_users_roles"})})
 * @ORM\Entity
 */
class UsersRolePoliciesUsersRoles
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="users_role_policies_users_roles_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \UsersRolePolicies
     *
     * @ORM\ManyToOne(targetEntity="UsersRolePolicies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_users_role_policies", referencedColumnName="id")
     * })
     */
    private $idUsersRolePolicies;

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

    public function getIdUsersRolePolicies(): ?UsersRolePolicies
    {
        return $this->idUsersRolePolicies;
    }

    public function setIdUsersRolePolicies(?UsersRolePolicies $idUsersRolePolicies): self
    {
        $this->idUsersRolePolicies = $idUsersRolePolicies;

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
