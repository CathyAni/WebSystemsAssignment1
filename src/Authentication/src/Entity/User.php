<?php

declare(strict_types=1);

namespace Authentication\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Mezzio\Authentication\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="user", indexes={@ORM\Index(name="IDX_6A6A46001334567", columns={"username"}), @ORM\Index(name="IDX_12D95C3950F7C5BF", columns={"email"})})
 */
class User implements UserInterface {

     /**
     * @var integer 
     * @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(nullable=false, unique=true)
     * @var string
     */
    private string $uid;

    /**
     * @var string
     * @ORM\Column(unique=true, nullable=false, type="string")
     */
    private string $username;


    /**
     * @ORM\Column(unique=true, nullable=false, type="string")
     * @var string
     */
    private string $email;

    /**
     * @ORM\Column(nullable=false)
     * @var string
     */
    private string $password;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $emailConfirmed;

    /**
     * @var \Datetime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private DateTime $createdOn;

    /**
     * @var \Datetime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private DateTime $updatedOn;


    /**
     * @var string
     * @ORM\Column(length=64, nullable=false)
     */
    private string $activationCode;


    // /**
    //  * @var Role
    //  * @ORM\ManyToOne(targetEntity="Role")
    //  */
    // private Role $role;

    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(
     *     name="user_roles",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     * @var ArrayCollection $roles
     */
    protected iterable $roles = [];

    /**
     * @var UserState
     * @ORM\ManyToOne(targetEntity="UserState")
     */
    private UserState $status;

    /**
     * @var string
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private bool $isActive;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private string $googleId;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private string $facebookId;

    /**
     * @var AuthType
     * @ORM\ManyToOne(targetEntity="AuthType")
     */
    private $authType;

    

    public function __contruct(){
        $this->roles = new ArrayCollection();
    }


    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     *
     * @return  string
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  string  $username
     *
     * @return  self
     */ 
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of createdOn
     *
     * @return  \Datetime
     */ 
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set the value of createdOn
     *
     * @param  \Datetime  $createdOn
     *
     * @return  self
     */ 
    public function setCreatedOn(\Datetime $createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get the value of updatedOn
     *
     * @return  \Datetime
     */ 
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set the value of updatedOn
     *
     * @param  \Datetime  $updatedOn
     *
     * @return  self
     */ 
    public function setUpdatedOn(\Datetime $updatedOn)
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * Get the value of role
     *
     * @return  Role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @param  Role  $role
     *
     * @return  self
     */ 
    public function setRole(Role $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  UserState
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /** 
     * Set the value of status
     *
     * @param  UserState  $status
     *
     * @return  self
     */ 
    public function setStatus(UserState $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of activationCode
     *
     * @return  string
     */ 
    public function getActivationCode()
    {
        return $this->activationCode;
    }

    /**
     * Set the value of activationCode
     *
     * @param  string  $activationCode
     *
     * @return  self
     */ 
    public function setActivationCode(string $activationCode)
    {
        $this->activationCode = $activationCode;

        return $this;
    }

    public function getIdentity(): string
    {
        return $this->username;
    }

    

    public function getDetails(): array
    {
        return [];
    }

    public function getDetail(string $name, $default = null)
    {
        return $default;
    }

    

    /**
     * Get the value of isActive
     */ 
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set the value of isActive
     *
     * @return  self
     */ 
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get the value of googleId
     */ 
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * Set the value of googleId
     *
     * @return  self
     */ 
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;

        return $this;
    }

    /**
     * Get the value of facebookId
     *
     * @return  string
     */ 
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * Set the value of facebookId
     *
     * @param  string  $facebookId
     *
     * @return  self
     */ 
    public function setFacebookId(string $facebookId)
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * Get the value of emailConfirmed
     *
     * @return  bool
     */ 
    public function getEmailConfirmed()
    {
        return $this->emailConfirmed;
    }

    /**
     * Set the value of emailConfirmed
     *
     * @param  bool  $emailConfirmed
     *
     * @return  self
     */ 
    public function setEmailConfirmed(bool $emailConfirmed)
    {
        $this->emailConfirmed = $emailConfirmed;

        return $this;
    }

    /**
     * Get the value of authType
     *
     * @return  AuthType
     */ 
    public function getAuthType()
    {
        return $this->authType;
    }

    /**
     * Set the value of authType
     *
     * @param  AuthType  $authType
     *
     * @return  self
     */ 
    public function setAuthType(AuthType $authType)
    {
        $this->authType = $authType;

        return $this;
    }

    /**
     * Get $roles
     *
     * @return  ArrayCollection
     */ 
    public function getRoles():iterable
    {
        return $this->roles;
    }

    /**
     * Set $roles
     *
     * @param  ArrayCollection  $roles  $roles
     *
     * @return  self
     */ 
    public function setRoles(ArrayCollection $roles)
    {
        $this->roles = $roles;

        return $this;
    }
}