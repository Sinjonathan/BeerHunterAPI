<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A color of beer.
 *
 * @ORM\Entity
 * @ORM\Table(name="color")
 */
class Color
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
     * @var String The name of the color.
     *
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    protected $name;

    /**
     * @var ArrayCollection The beers from this country
     *
     * @ORM\OneToMany(targetEntity="Beer", mappedBy="color")
     */
    protected $beers;

    public function __construct()
    {
        $this->beers = new ArrayCollection();
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
}