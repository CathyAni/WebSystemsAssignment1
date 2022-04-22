<?php

declare(strict_types=1);

namespace Customer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Authentication\Entity\User;
use Documents\Entity\Documents;
use General\Entity\Country;
use General\Entity\Zone;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer", indexes={
 *     @ORM\Index(name="search_idx", columns={"customer_name", "account_id"})
 * })
 */

class Customer
{


    /**
     * @var integer 
     * @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var CustomerType
     * @ORM\ManyToOne(targetEntity="CustomerType")
     */
    private CustomerType $customerType;

    /**
     * @ORM\Column(type="string", name="customer_name", nullable=false)
     */
    private string $customerName;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Authentication\Entity\User")
     */
    private User $user;

    /**
     * @var Documents\Entity\Documents
     * @ORM\ManyToOne(targetEntity="Documents\Entity\Documents")
     */
    private Documents $customerImage;

    /**
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $address1;


    /**
     * @ORM\Column(nullable=true)
     */
    private $address2;


    /**
     * @var string
     * @ORM\Column(nullable=true)
     */
    private string $city;

    /**
     * @var Zone
     * @ORM\ManyToOne(targetEntity="General\Entity\Zone")
     */
    private Zone $state;

    /**
     * @var Country
     * @ORM\ManyToOne(targetEntity="General\Entity\Country")
     */
    private Country $country;

    /**
     * @var \Datetime
     * @ORM\Column(type="date", nullable=true)
     */
    private \Datetime $dob;

    /**
     * @var \Datetime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $createdOn;

    /**
     * @var \Datetime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $updatedOn;

    /**
     * @ORM\Column(name="account_id", type="string", nullable=false, unique=true)
     *
     * @var string
     */
    private $accountId;


    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=false,  options={"default" : 0})
     */
    private $isHidden;



    /**
     * Get the value of id
     *
     * @return  integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  integer  $id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of customerType
     *
     * @return  CustomerType
     */
    public function getCustomerType()
    {
        return $this->customerType;
    }

    /**
     * Set the value of customerType
     *
     * @param  CustomerType  $customerType
     *
     * @return  self
     */
    public function setCustomerType(CustomerType $customerType)
    {
        $this->customerType = $customerType;

        return $this;
    }

    /**
     * Get the value of customerName
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Set the value of customerName
     *
     * @return  self
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * Get the value of user
     *
     * @return  User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  User  $user
     *
     * @return  self
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of customerImage
     *
     * @return  Documents\Entity\Documents
     */
    public function getCustomerImage()
    {
        return $this->customerImage;
    }

    /**
     * Set the value of customerImage
     *
     * @param  Documents\Entity\Documents  $customerImage
     *
     * @return  self
     */
    public function setCustomerImage(\Documents\Entity\Documents $customerImage)
    {
        $this->customerImage = $customerImage;

        return $this;
    }

    /**
     * Get the value of address1
     *
     * @return  string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set the value of address1
     *
     * @param  string  $address1
     *
     * @return  self
     */
    public function setAddress1(string $address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get the value of address2
     */ 
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set the value of address2
     *
     * @return  self
     */ 
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get the value of city
     *
     * @return  string
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @param  string  $city
     *
     * @return  self
     */ 
    public function setCity(string $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of state
     *
     * @return  Zone
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @param  Zone  $state
     *
     * @return  self
     */ 
    public function setState(Zone $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of dob
     *
     * @return  \Datetime
     */ 
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set the value of dob
     *
     * @param  \Datetime  $dob
     *
     * @return  self
     */ 
    public function setDob(\Datetime $dob)
    {
        $this->dob = $dob;

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
     * Get the value of country
     *
     * @return  Country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @param  Country  $country
     *
     * @return  self
     */ 
    public function setCountry(Country $country)
    {
        $this->country = $country;

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
     * Get the value of accountId
     *
     * @return  string
     */ 
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set the value of accountId
     *
     * @param  string  $accountId
     *
     * @return  self
     */ 
    public function setAccountId(string $accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }
}
