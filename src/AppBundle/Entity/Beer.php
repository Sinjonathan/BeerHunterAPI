<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * A beer.
 *
 * @ORM\Entity
 * @ORM\Table(name="beer")
 */
class Beer
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
     * @var String The name of a beer.
     *
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    protected $name;

    /**
     * @var Color the color of a beer.
     *
     * @ORM\ManyToOne(targetEntity="Color", inversedBy="beers", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="color_id", referencedColumnName="id")
     */
    protected $color;

    /**
     * @var double The degree of a beer.
     *
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=false)
     * @Assert\Type(type="double")
     */
    protected $degree;

    /**
     * @var String The description of a beer.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var Country the location where the beer is created.
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="beers", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    protected $origin;

    /**
     * @var ArrayCollection The hunts about this beer.
     *
     * @ORM\OneToMany(targetEntity="Hunt", mappedBy="beer")
     */
    protected $hunts;

    public function __construct()
    {
        $this->hunts = new ArrayCollection();
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
     * @return Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param Color $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return double
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * @param double $degree
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return Country
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param Country $origin
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    /**
     * @return ArrayCollection
     */
    public function getHunts()
    {
        return $this->hunts;
    }

    /**
     * @param ArrayCollection $hunts
     */
    public function setHunts($hunts)
    {
        $this->hunts = $hunts;
    }

    public function __toString()
    {
        return $this->name;
    }
}