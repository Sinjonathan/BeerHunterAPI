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
     * @OneToOne(targetEntity="Address", mappedBy="address")
     */
    protected $address;

    /**
     * @var ArrayCollection The hunts in this bar.
     *
     * @ORM\OneToMany(targetEntity="Hunt", mappedBy="bar")
     */
    protected $hunts;

    protected $geolocation;

    public function __construct()
    {
        $this->hunts = new ArrayCollection();
    }
}