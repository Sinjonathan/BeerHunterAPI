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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var String The address of the bar.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $address;

    /**
     * @var String The city of the bar.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $city;

    /**
     * @var int The postal code of the bar.
     *
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    protected $postal;

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
     * @return String
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param String $address
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

    /**
     * @return String
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param String $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return int
     */
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * @param int $postal
     */
    public function setPostal($postal)
    {
        $this->postal = $postal;
    }

    public function __toString()
    {
        return $this->name;
    }
}