<?php
declare(strict_types=1);

namespace Women\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="occupation")
 */

class Occupation {

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
    private $pation;


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
     * Get the value of pation
     */ 
    public function getPation()
    {
        return $this->pation;
    }

    /**
     * Set the value of pation
     *
     * @return  self
     */ 
    public function setPation($pation)
    {
        $this->pation = $pation;

        return $this;
    }
}