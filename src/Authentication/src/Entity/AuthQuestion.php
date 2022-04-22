<?php
 declare(strict_types= 1);

 namespace Authentication\Entity;

 use Doctrine\ORM\Mapping as ORM;
 /**
  * @ORM\Entity
  * @ORM\Table(name="auth_question")
  * 
  */
 class AuthQuestion{

     /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     *      
     */
    private int $id;

    /**
     * @var integer 
     * @ORM\Column(nullable=false)
     */
    private string $language;

    


    /**
     * Get the value of language
     *
     * @return  integer
     */ 
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the value of language
     *
     * @param  integer  $language
     *
     * @return  self
     */ 
    public function setLanguage($language)
    {
        $this->language = $language;

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