<?php

declare(strict_types=1);

namespace General\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="country")
 */
class Country
{
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @var string @ORM\Column(name="country_name", type="string", length=128, nullable=true)
     */
    private $countryName;

    /**
     *
     * @var string @ORM\Column(name="iso_code_2", type="string", length=2, nullable=true)
     */
    private $isoCode2;

    /**
     *
     * @var string @ORM\Column(name="iso_code_3", type="string", length=6, nullable=true)
     */
    private $isoCode3;

    /**
     *
     * @var string @ORM\Column(name="address_format", type="text", nullable=true)
     */
    private $addressFormat;

    /**
     *
     * @var boolean @ORM\Column(name="postcode_required", type="boolean", nullable=true)
     */
    private $postcodeRequired;

    /**
     *
     * @var boolean @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;
}
