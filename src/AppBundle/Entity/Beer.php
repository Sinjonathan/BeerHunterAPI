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
     * @ORM\ManyToOne(targetEntity="Color", inversedBy="beers")
     * @ORM\JoinColumn(name="color_id", referencedColumnName="id")
     */
    protected $color;

    /**
     * @var float The degree of a beer.
     *
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=false)
     * @Assert\Type(type="float")
     */
    protected $degree;

    /**
     * @var String The description of a beer.
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $description;

    /**
     * @var Country the location where the beer is created.
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="beers")
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
}