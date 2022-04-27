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
     * Get the value of storyUid
     *
     * @return  string
     */ 
    public function getStoryUid()
    {
        return $this->storyUid;
    }

    /**
     * Set the value of storyUid
     *
     * @param  string  $storyUid
     *
     * @return  self
     */ 
    public function setStoryUid(string $storyUid)
    {
        $this->storyUid = $storyUid;

        return $this;
    }

    /**
     * Get the value of storyHeader
     */ 
    public function getStoryHeader()
    {
        return $this->storyHeader;
    }

    /**
     * Set the value of storyHeader
     *
     * @return  self
     */ 
    public function setStoryHeader($storyHeader)
    {
        $this->storyHeader = $storyHeader;

        return $this;
    }

    /**
     * Get the value of storyBody
     */ 
    public function getStoryBody()
    {
        return $this->storyBody;
    }

    /**
     * Set the value of storyBody
     *
     * @return  self
     */ 
    public function setStoryBody($storyBody)
    {
        $this->storyBody = $storyBody;

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
     * Get the value of writer
     */ 
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * Set the value of writer
     *
     * @return  self
     */ 
    public function setWriter($writer)
    {
        $this->writer = $writer;

        return $this;
    }
}
