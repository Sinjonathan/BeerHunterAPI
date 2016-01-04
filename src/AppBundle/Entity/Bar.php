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
     * @ORM\OneToOne(targetEntity="Address", mappedBy="address")
     */
    protected $address;

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
}