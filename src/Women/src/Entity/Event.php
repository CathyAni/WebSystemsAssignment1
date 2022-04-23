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
}