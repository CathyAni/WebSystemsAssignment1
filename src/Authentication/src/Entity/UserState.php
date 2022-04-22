<?php

declare(strict_types=1);

namespace Authentication\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="user_state")
 * 
 * 
 */

class UserState
{

    /**
     * @var integer 
     * @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;



    /**
     * @var string
     * @ORM\Column(nullable=false)
     */
    private string  $status;




    /**
     * Get the value of status
     *
     * @return  string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  string  $status
     *
     * @return  self
     */
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }

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
}
