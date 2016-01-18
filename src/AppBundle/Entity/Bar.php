<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A bar.
 *
 * @ORM\Entity
 * @ORM\Table(name="bar")
 */
class Bar
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
     * @var String The name of the bar.
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var String The description of the bar.
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $description;

    /**
     * @var Address The address of the bar.
     *
     * @ORM\OneToOne(targetEntity="Address", inversedBy="bar", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    protected $address;

    /**
     * @var double The longitude of the bar.
     *
     * @ORM\Column(type="decimal", precision=15, scale=12, nullable=false)
     * @Assert\Type(type="double")
     */
    protected $longitude;

    /**
     * @var double The latitude of the bar.
     *
     * @ORM\Column(type="decimal", precision=15, scale=12, nullable=false)
     * @Assert\Type(type="double")
     */
    protected $latitude;

    /**
     * @var ArrayCollection The hunts in this bar.
     *
     * @ORM\OneToMany(targetEntity="Hunt", mappedBy="bar")
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
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
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

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function __toString()
    {
        return $this->name;
    }
}