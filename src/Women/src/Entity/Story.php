<?php

declare(strict_types=1);

namespace Women\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="story")
 */

class Story
{

    /** @var int
     *
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="story_uid", type="string", length="50", nullable=false, unique=true)
     * @var string
     */
    private  $storyUid;


    /**
     * @ORM\Column(nullable=false)
     */
    private $storyHeader;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $storyBody;

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
     */
    private $writer;
}
