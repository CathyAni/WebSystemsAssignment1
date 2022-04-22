<?php

declare(strict_types=1);

namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="claims")
 */

class Claims {

     /**
     * @var integer 
     * @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     *
     * @ORM\Column(name="is_board", type="boolean", nullable=true)
     * @var boolean
     */
    private $isBoard;

    

    /**
     *
     * @ORM\ManyToMany(targetEntity="Documents\Entity\Documents")
     * @ORM\JoinTable(name="claims_customer_doc",
     * joinColumns={@ORM\JoinColumn(name="claims", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="doc", referencedColumnName="id")}
     * )
     * This is a series of document associated to this claims
     * available to the customer but uploaded by the admin/broker
     *
     * @var Collection
     */
    private $claimsDoc;

    /**
     *
     * @ORM\Column(name="claim_uid", nullable=false)
     *
     * @var string
     */
    private $claimUid;

    /**
     *
     * @ORM\Column(name="claim_topic", type="string", nullable=true)
     *
     * @var string
     */
    private $claimTopic;

    // /**
    //  *
    //  * @var \Policy\Entity\Policy @ORM\ManyToOne(targetEntity="Policy\Entity\Policy", inversedBy="claims")
    //  *      @ORM\JoinColumns({
    //  *      @ORM\JoinColumn(name="policy_id", referencedColumnName="id")
    //  *      })
    //  *
    //  */
    // private $policy;

    /**
     *
     * @ORM\OneToMany(targetEntity="Comments\Entity\Comments", mappedBy="claims")
     *
     * @var Collection
     */
    private $comments;

    /**
     *
     * @var ClaimsStatus @ORM\ManyToOne(targetEntity="ClaimsStatus")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="claims_status_id", referencedColumnName="id")
     *      })
     *
     *      This is a unidirectional Many to One mapping to CLaims Status Entity
     */
    private $claimStatus;

    /**
     *
     * @var string @ORM\Column(name="claim_info", type="text", nullable=true)
     */
    private $claimInfo;

    // /**
    // *
    // * @var Document @ORM\ManyToMany(targetEntity="GeneralServicer\Entity\Document")
    // * @ORM\JoinTable(name="claims_document",
    // * @ORM\JoinColumns={@ORM\JoinColumn(name="claims_id", referencedColumnName="id")},
    // * inverseJoinColumns={@ORM\JoinColumn(name="doc_id", referencedColumnName="id")}
    // * )
    // *
    // * This is a many to many unidirectional mapping to document entity
    // */
    // private $docId;

    /**
     *
     * @var \DateTime @ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    private $createdOn;

    /**
     *
     * @var \DateTime @ORM\Column(name="updated_on", type="datetime", nullable=true)
     */
    private $updatedOn;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Customer\Entity\Customer")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="customer", referencedColumnName="id")
     * })
     *
     * @var Customer
     */
    private $customer;

    /**
     * THis deffines if the claims is setllted/approved or not
     * This indicate wheter the claims was approved
     * True for approved
     * false for declined
     *
     * @ORM\Column(name="is_settled", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isSettled;

    /**
     *
     * @ORM\OneToOne(targetEntity="ClaimsSettlement", mappedBy="claims")
     * @var ClaimsSettlement
     */
    private $claimsSettled;

    // /**
    // * @ORM\ManyToOne(targetEntity="CLaims\Entity\ClaimsBroker", mappedBy="claims", cascade={"persist", "remove"})
    // *
    // * @var Broker
    // */
    // private $broker;

    /**
     * THis deffines if the claims is hiidden/deleted or not
     *
     * @ORM\Column(name="is_hidden", type="boolean", nullable=false)
     *
     * @var boolean
     */
    private $isHidden;

    /**
     * The date the claims was completed
     *
     * @ORM\Column(name="claims_completed_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $claimsCompletedDate;

    /**
     * Date the claims was settled
     *
     * @ORM\Column(name="claims_settled_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $claimsSettledDate;

    /**
     * Date Broker began the processing of the claims
     *
     * @ORM\Column(name="claims_processing_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $claimsProcessingDate;

    /**
     * Reason Claims was unpaid
     *
     * @ORM\Column(name="unpaid_reason", type="text", nullable=true)
     *
     * @var string
     */
    private $unpaidReason;

    /**
     * Reason Claims was Declined
     *
     * @ORM\Column(name="declined_reason", type="string", nullable=true)
     *
     * @var string
     */
    private $declineResason;

    /**
     * @ORM\Column(name="reason_decription", type="text", nullable=true)
     * @var string
     */
    private $reasonDescription;

}