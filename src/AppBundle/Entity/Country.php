<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A country.
 *
 * @ORM\Entity
 * @ORM\Table(name="country")
 */
class Country
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
     * @var String The name of a country.
     *
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    protected $name;

    /**
     * @var String The short name of a country.
     *
     * @ORM\Column(type="string", length=3, unique=true, nullable=false)
     */
    protected $short;

    /**
     * @var ArrayCollection The beers from this country
     *
     * @ORM\OneToMany(targetEntity="Beer", mappedBy="origin")
     */
    protected $beers;

    /**
     * @var ArrayCollection The cities in this country
     *
     * @ORM\OneToMany(targetEntity="City", mappedBy="country")
     */
    protected $cities;

    public function __construct()
    {
        $this->beers = new ArrayCollection();
        $this->cities = new ArrayCollection();
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
     * @return String
     */
    public function getShort()
    {
        return $this->short;
    }

    /**
     * @param String $short
     */
    public function setShort($short)
    {
        $this->short = $short;
    }

    /**
     * @return ArrayCollection
     */
    public function getBeers()
    {
        return $this->beers;
    }

    /**
     * @param ArrayCollection $beers
     */
    public function setBeers($beers)
    {
        $this->beers = $beers;
    }

    /**
     * @return ArrayCollection
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * @param ArrayCollection $cities
     */
    public function setCities($cities)
    {
        $this->cities = $cities;
    }

    public function __toString()
    {
        return $this->name;
    }
}