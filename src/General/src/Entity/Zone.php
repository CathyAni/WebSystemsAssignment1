<?php

declare(strict_types =1);

namespace General\Entity;

use Doctrine\ORM\Mapping as ORM;
use General\Entity\Country as Country;
/**
 * @ORM\Entity
 * @ORM\Table(name="zone" , indexes={@ORM\Index(name="FK_zone_country_idx", columns={"country_id"})})
 */

class Zone{
     /**
     *
     * @var integer 
     * @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     *
     * @var string 
     * @ORM\Column(name="zone_name", type="string", length=128, nullable=false)
     */
    private string $zoneName;

    /**
     *
     * @var string
     *  @ORM\Column(name="code", type="string", length=32, nullable=false)
     */
    private string $code;

    /**
     *
     * @var integer 
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private string $status;

    /**
     *
     * @var Country  @ORM\ManyToOne(targetEntity="Country")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     *      })
     */
    private Country $country;

   

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
     * Get the value of zoneName
     *
     * @return  string
     */ 
    public function getZoneName()
    {
        return $this->zoneName;
    }

    /**
     * Set the value of zoneName
     *
     * @param  string  $zoneName
     *
     * @return  self
     */ 
    public function setZoneName(string $zoneName)
    {
        $this->zoneName = $zoneName;

        return $this;
    }

    /**
     * Get the value of code
     *
     * @return  string
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @param  string  $code
     *
     * @return  self
     */ 
    public function setCode(string $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  integer
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  integer  $status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get @ORM\ManyToOne(targetEntity="Country")
     *
     * @return  Country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set @ORM\ManyToOne(targetEntity="Country")
     *
     * @param  Country  $country  @ORM\ManyToOne(targetEntity="Country")
     *
     * @return  self
     */ 
    public function setCountry(Country $country)
    {
        $this->country = $country;

        return $this;
    }
}