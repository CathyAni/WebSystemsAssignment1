<?php

declare(strict_types=1);

namespace Documents\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="documents")
 */
class Documents
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private string $id;

    /**
     *
     * @var string @ORM\Column(name="doc_name", type="string", length=200, nullable=true)
     */
    private string $docName;


    /**
     *
     * @var string @ORM\Column(name="doc_url", type="string", length=500, nullable=true)
     */
    private string  $docUrl;

    /**
     *
     * @var bool @ORM\Column(name="is_confirmed", type="boolean", nullable=true)
     */
    private bool $isConfirmed;

    /**
     *
     * @var \DateTime @ORM\Column(name="created_on", type="datetime", length=100, nullable=true)
     */
    private \DateTime $createdOn;

    /**
     *
     * @var \DateTime @ORM\Column(name="updated_on", type="datetime", length=100, nullable=true)
     */
    private \DateTime $updatedOn;

    /**
     *
     * @var bool @ORM\Column(name="is_hidden", type="boolean", nullable=true)
     */
    private bool $isHidden;

    /**
     *
     * @var string @ORM\Column(name="mime_type", type="string", length=100, nullable=true)
     */
    private string $mimeType;

    /**
     *
     * @var string @ORM\Column(name="doc_ext", type="string", length=45, nullable=true)
     */
    private string $docExt;

    /**
     *
     * @var string @ORM\Column(name="doc_code", type="string", length=100, nullable=true)
     */
    private string $docCode;

    /**
     *
     * @var \Documents\Entity\DocumentStatus @ORM\ManyToOne(targetEntity="DocumentStatus")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="doc_status", referencedColumnName="id")
     *      })
     */
    private DocumentStatus $docStatus;

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
     * Get @ORM\ManyToOne(targetEntity="DocumentStatus")
     *
     * @return  \Documents\Entity\DocumentStatus
     */ 
    public function getDocStatus()
    {
        return $this->docStatus;
    }

    /**
     * Set @ORM\ManyToOne(targetEntity="DocumentStatus")
     *
     * @param  \Documents\Entity\DocumentStatus  $docStatus  @ORM\ManyToOne(targetEntity="DocumentStatus")
     *
     * @return  self
     */ 
    public function setDocStatus(\Documents\Entity\DocumentStatus $docStatus)
    {
        $this->docStatus = $docStatus;

        return $this;
    }

    /**
     * Get @ORM\Column(name="doc_code", type="string", length=100, nullable=true)
     *
     * @return  string
     */ 
    public function getDocCode()
    {
        return $this->docCode;
    }

    /**
     * Set @ORM\Column(name="doc_code", type="string", length=100, nullable=true)
     *
     * @param  string  $docCode  @ORM\Column(name="doc_code", type="string", length=100, nullable=true)
     *
     * @return  self
     */ 
    public function setDocCode(string $docCode)
    {
        $this->docCode = $docCode;

        return $this;
    }

    /**
     * Get @ORM\Column(name="doc_name", type="string", length=200, nullable=true)
     *
     * @return  string
     */ 
    public function getDocName()
    {
        return $this->docName;
    }

    /**
     * Set @ORM\Column(name="doc_name", type="string", length=200, nullable=true)
     *
     * @param  string  $docName  @ORM\Column(name="doc_name", type="string", length=200, nullable=true)
     *
     * @return  self
     */ 
    public function setDocName(string $docName)
    {
        $this->docName = $docName;

        return $this;
    }

    /**
     * Get @ORM\Column(name="doc_url", type="string", length=500, nullable=true)
     *
     * @return  string
     */ 
    public function getDocUrl()
    {
        return $this->docUrl;
    }

    /**
     * Set @ORM\Column(name="doc_url", type="string", length=500, nullable=true)
     *
     * @param  string  $docUrl  @ORM\Column(name="doc_url", type="string", length=500, nullable=true)
     *
     * @return  self
     */ 
    public function setDocUrl(string $docUrl)
    {
        $this->docUrl = $docUrl;

        return $this;
    }

    /**
     * Get @ORM\Column(name="is_confirmed", type="boolean", nullable=true)
     *
     * @return  boolean
     */ 
    public function getIsConfirmed()
    {
        return $this->isConfirmed;
    }

    /**
     * Set @ORM\Column(name="is_confirmed", type="boolean", nullable=true)
     *
     * @param  boolean  $isConfirmed  @ORM\Column(name="is_confirmed", type="boolean", nullable=true)
     *
     * @return  self
     */ 
    public function setIsConfirmed(bool $isConfirmed)
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }

    /**
     * Get @ORM\Column(name="created_on", type="datetime", length=100, nullable=true)
     *
     * @return  \DateTime
     */ 
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set @ORM\Column(name="created_on", type="datetime", length=100, nullable=true)
     *
     * @param  \DateTime  $createdOn  @ORM\Column(name="created_on", type="datetime", length=100, nullable=true)
     *
     * @return  self
     */ 
    public function setCreatedOn(\DateTime $createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get @ORM\Column(name="updated_on", type="datetime", length=100, nullable=true)
     *
     * @return  \DateTime
     */ 
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set @ORM\Column(name="updated_on", type="datetime", length=100, nullable=true)
     *
     * @param  \DateTime  $updatedOn  @ORM\Column(name="updated_on", type="datetime", length=100, nullable=true)
     *
     * @return  self
     */ 
    public function setUpdatedOn(\DateTime $updatedOn)
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * Get @ORM\Column(name="is_hidden", type="boolean", nullable=true)
     *
     * @return  bool
     */ 
    public function getIsHidden()
    {
        return $this->isHidden;
    }

    /**
     * Set @ORM\Column(name="is_hidden", type="boolean", nullable=true)
     *
     * @param  bool  $isHidden  @ORM\Column(name="is_hidden", type="boolean", nullable=true)
     *
     * @return  self
     */ 
    public function setIsHidden(bool $isHidden)
    {
        $this->isHidden = $isHidden;

        return $this;
    }

    /**
     * Get @ORM\Column(name="mime_type", type="string", length=100, nullable=true)
     *
     * @return  string
     */ 
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set @ORM\Column(name="mime_type", type="string", length=100, nullable=true)
     *
     * @param  string  $mimeType  @ORM\Column(name="mime_type", type="string", length=100, nullable=true)
     *
     * @return  self
     */ 
    public function setMimeType(string $mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get @ORM\Column(name="doc_ext", type="string", length=45, nullable=true)
     *
     * @return  string
     */ 
    public function getDocExt()
    {
        return $this->docExt;
    }

    /**
     * Set @ORM\Column(name="doc_ext", type="string", length=45, nullable=true)
     *
     * @param  string  $docExt  @ORM\Column(name="doc_ext", type="string", length=45, nullable=true)
     *
     * @return  self
     */ 
    public function setDocExt(string $docExt)
    {
        $this->docExt = $docExt;

        return $this;
    }
}
