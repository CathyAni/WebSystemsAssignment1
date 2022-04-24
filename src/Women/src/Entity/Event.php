<?php

declare(strict_types=1);

namespace Women\Entity;

use Doctrine\ORM\Mapping as ORM;
use Authentication\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="event")
 */

class Event{
    /** @var int
     *
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @ORM\Column(nullable=false)
     */
    private $eventName;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $eventDecsription;

   /**
     * @var \Datetime
     * @ORM\Column(nullable=false, type="datetime")
     */
    private $createdAt;


    /**
     * @ORM\Column(nullable=false, type="datetime")
     * @var \Datetime
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Authentication\Entity\User")
     * @var User
     */
    private $creator;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of eventName
     */ 
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * Set the value of eventName
     *
     * @return  self
     */ 
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * Get the value of startDate
     */ 
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set the value of startDate
     *
     * @return  self
     */ 
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the value of eventDecsription
     */ 
    public function getEventDecsription()
    {
        return $this->eventDecsription;
    }

    /**
     * Set the value of eventDecsription
     *
     * @return  self
     */ 
    public function setEventDecsription($eventDecsription)
    {
        $this->eventDecsription = $eventDecsription;

        return $this;
    }

    /**
     * Get the value of updatedAt
     *
     * @return  \Datetime
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @param  \Datetime  $updatedAt
     *
     * @return  self
     */ 
    public function setUpdatedAt(\Datetime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get the value of creator
     *
     * @return  User
     */ 
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set the value of creator
     *
     * @param  User  $creator
     *
     * @return  self
     */ 
    public function setCreator(User $creator)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get the value of createdAt
     *
     * @return  \Datetime
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param  \Datetime  $createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt(\Datetime $createdAt)
    {
        $this->createdAt = $createdAt;
        $this->updatedAt = $createdAt;

        return $this;
    }
}