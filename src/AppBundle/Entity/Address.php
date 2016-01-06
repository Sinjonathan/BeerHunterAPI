<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An address.
 *
 * @ORM\Entity
 * @ORM\Table(name="address")
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
    protected $street;

    /**
     * @var City The city where is located the address.
     *
     * @ORM\ManyToOne(targetEntity="City", inversedBy="streets", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    protected $city;

    /**
     * @var Bar The bar associated to this address.
     *
     * @ORM\OneToOne(targetEntity="Bar", inversedBy="address", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="bar_id", referencedColumnName="id")
     */
    protected $bar;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param String $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param City $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return Bar
     */
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * @param Bar $bar
     */
    public function setBar($bar)
    {
        $this->bar = $bar;
    }

    public function __toString()
    {
        return $this->number . ' ' . $this->street . ', ' . $this->city;
    }
}