<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A hunt.
 *
 * @ORM\Entity
 * @ORM\Table(name="hunt")
 */
class Hunt
{
    const STATUS_ACTIVE = 0;
    const STATUS_VALID = 1;
    const STATUS_UNAVAILABLE = 2;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime Launch date of the hunt.
     *
     * @ORM\Column(type="date", nullable=false)
     * @Assert\Date
     */
    protected $launchDate;

    /**
     * @var boolean If the hunted beer is pressure or not.
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $isPressure;

    /**
     * @var int The actual balance of vote for this hunt.
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $balance = 0;

    /**
     * @var Beer The hunted beer.
     *
     * @ORM\ManyToOne(targetEntity="Beer", inversedBy="hunts")
     * @ORM\JoinColumn(name="beer_id", referencedColumnName="id")
     */
    protected $beer;

    /**
     * @var Bar The bar where the beer is hunted.
     *
     * @ORM\ManyToOne(targetEntity="Bar", inversedBy="hunts")
     * @ORM\JoinColumn(name="bar_id", referencedColumnName="id")
     */
    protected $bar;

    protected $status = Hunt::STATUS_ACTIVE;

    public function __construct()
    {
        $this->launchDate = new \DateTime();
    }
}