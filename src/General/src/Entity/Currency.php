<?php

declare(strict_types=1);

namespace General\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="general_currency")
 */
class Currency{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @var string @ORM\Column(name="title", type="string", length=45, nullable=true)
     */
    private $title;

    /**
     *
     * @var string @ORM\Column(name="code", type="string", length=10, nullable=true)
     */
    private $code;

    /**
     *
     * @var string @ORM\Column(name="iso_code", type="string", length=45, nullable=true)
     */
    private $isoCode;
    
    /**
     * @var string @ORM\Column(name="payment_code", type="string", length=45, nullable=true)
     *
     */
    private $paymentCode;


    /**
     * Get @ORM\Column(name="id", type="integer", nullable=false)
     *
     * @return  integer
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set @ORM\Column(name="id", type="integer", nullable=false)
     *
     * @param  integer  $id  @ORM\Column(name="id", type="integer", nullable=false)
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get @ORM\Column(name="title", type="string", length=45, nullable=true)
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set @ORM\Column(name="title", type="string", length=45, nullable=true)
     *
     * @param  string  $title  @ORM\Column(name="title", type="string", length=45, nullable=true)
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get @ORM\Column(name="code", type="string", length=10, nullable=true)
     *
     * @return  string
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set @ORM\Column(name="code", type="string", length=10, nullable=true)
     *
     * @param  string  $code  @ORM\Column(name="code", type="string", length=10, nullable=true)
     *
     * @return  self
     */ 
    public function setCode(string $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get @ORM\Column(name="iso_code", type="string", length=45, nullable=true)
     *
     * @return  string
     */ 
    public function getIsoCode()
    {
        return $this->isoCode;
    }

    /**
     * Set @ORM\Column(name="iso_code", type="string", length=45, nullable=true)
     *
     * @param  string  $isoCode  @ORM\Column(name="iso_code", type="string", length=45, nullable=true)
     *
     * @return  self
     */ 
    public function setIsoCode(string $isoCode)
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    /**
     * Get @ORM\Column(name="payment_code", type="string", length=45, nullable=true)
     *
     * @return  string
     */ 
    public function getPaymentCode()
    {
        return $this->paymentCode;
    }

    /**
     * Set @ORM\Column(name="payment_code", type="string", length=45, nullable=true)
     *
     * @param  string  $paymentCode  @ORM\Column(name="payment_code", type="string", length=45, nullable=true)
     *
     * @return  self
     */ 
    public function setPaymentCode(string $paymentCode)
    {
        $this->paymentCode = $paymentCode;

        return $this;
    }
}