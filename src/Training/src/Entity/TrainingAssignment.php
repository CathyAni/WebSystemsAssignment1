<?php
namespace Training\Entity;

use Doctrine\ORM\Mapping as ORM;


class TrainingAssignment
{

    /**
     *
     * @var int @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="assignment_uid", type="string", nullable=false)
     * 
     * @var string
     */
    private $assigmentUid;

    /**
     * @ORM\ManyToOne(targetEntity="Training")
     * 
     * @var Training
     */
    private $training;

    /**
     * @ORM\Column(name="details", type="string", nullable=true)
     * 
     * @var string
     */
    private $details;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * 
     * @var unknown
     */
    private $createdOn;
}

