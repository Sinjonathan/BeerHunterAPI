<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A city.
 *
 * @ORM\Entity
 * @ORM\Table(name="city")
 */
class City
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
     * @var String The name of a city.
     *
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    protected $name;

    /**
     * @var Address All the address of a city
     *
     * @ORM\OneToMany(targetEntity="Address", mappedBy="city")
     */
    protected $streets;

    /**
     * @var Country the location of the city.
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="cities")
     * @ORM\JoinColumn(name="cities_id", referencedColumnName="id")
     */
    protected $country;

    public function __construct()
    {
        $this->streets = new ArrayCollection();
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Address
     */
    public function getStreets()
    {
        return $this->streets;
    }

    /**
     * @param Address $streets
     */
    public function setStreets($streets)
    {
        $this->streets = $streets;
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param Country $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }
}