<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An address.
 *
 * @ORM\Entity
 * @ORM\Table(name="city")
 */
class Address
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int The number in the street.
     *
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\Type(type="integer")
     */
    protected $number;

    /**
     * @var String The name of the street.
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="streets")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    protected $city;

    /**
     * @OneToOne(targetEntity="Bar", inversedBy="address")
     * @JoinColumn(name="bar_id", referencedColumnName="id")
     */
    protected $bar;
}