<?php
declare(strict_types=1);

namespace Authentication\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("auth_type")
 * This could either be
 * email
 * google
 * facebook
 */
class AuthType{

      /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     *      
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $type;


    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get @ORM\Column(name="id", type="integer")
     *
     * @return  integer
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set @ORM\Column(name="id", type="integer")
     *
     * @param  integer  $id  @ORM\Column(name="id", type="integer")
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}