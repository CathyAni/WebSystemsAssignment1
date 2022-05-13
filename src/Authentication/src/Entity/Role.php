<?php

declare(strict_types=1);

namespace Authentication\Entity;

use Doctrine\ORM\Mapping as ORM;
use Laminas\Permissions\Rbac\RoleInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="role")
 */

class Role implements RoleInterface
{
    /**
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(nullable=false, length="50")
     */
    private $role;

    /**
     * @var Role
     * @ORM\ManyToOne(targetEntity="Role")
     */
    private $parentRole;

    /**
     * Get the value of role
     *
     * @return  string
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @param  string  $role
     *
     * @return  self
     */ 
    public function setRole(string $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of parentRole
     *
     * @return  Role
     */ 
    public function getParentRole()
    {
        return $this->parentRole;
    }

    /**
     * Set the value of parentRole
     *
     * @param  Role  $parentRole
     *
     * @return  self
     */ 
    public function setParentRole(Role $parentRole)
    {
        $this->parentRole = $parentRole;

        return $this;
    }

    /**
     * Get @ORM\Column(name="id", type="integer")
     *
     * @return  integer
     */ 
    public function getId()
    {
        return $this->id;
    }

    public function getName():string
    {
        return $this->role;
    }

    public function addPermission(string $name): void
    {
        
    }

    public function addChild( $child): void
    {
        
    }

    public function addParent( $parent): void
    {
        
    }

    public function hasPermission(string $name): bool
    {
        return true;
    }

    public function getChildren(): iterable
    {
        return [];
    }

    public function getParents(): iterable
    {
        return [];
    }

   
}
