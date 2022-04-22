<?php

declare(strict_types=1);

namespace Documents\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="document_status")
 */

class DocumentStatus
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     *
     * @var integer @ORM\Column(name="status", type="string", nullable=true)
     */
    private string $status;

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
     * Get @ORM\Column(name="status", type="string", nullable=true)
     *
     * @return  integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set @ORM\Column(name="status", type="string", nullable=true)
     *
     * @param  integer  $status  @ORM\Column(name="status", type="string", nullable=true)
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}
