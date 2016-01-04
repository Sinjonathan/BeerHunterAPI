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

    /**
     * @var Hunter the hunter of this hunt.
     *
     * @ORM\ManyToOne(targetEntity="Hunter", inversedBy="hunts")
     * @ORM\JoinColumn(name="hunter_id", referencedColumnName="id")
     */
    protected $hunter;

    protected $status = Hunt::STATUS_ACTIVE;

    public function __construct()
    {
        $this->launchDate = new \DateTime();
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
     * @return \DateTime
     */
    public function getLaunchDate()
    {
        return $this->launchDate;
    }

    /**
     * @param \DateTime $launchDate
     */
    public function setLaunchDate($launchDate)
    {
        $this->launchDate = $launchDate;
    }

    /**
     * @return boolean
     */
    public function isIsPressure()
    {
        return $this->isPressure;
    }

    /**
     * @param boolean $isPressure
     */
    public function setIsPressure($isPressure)
    {
        $this->isPressure = $isPressure;
    }

    /**
     * @return int
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return Beer
     */
    public function getBeer()
    {
        return $this->beer;
    }

    /**
     * @param Beer $beer
     */
    public function setBeer($beer)
    {
        $this->beer = $beer;
    }

    /**
     * @return Bar
     */
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * @param Bar $bar
     */
    public function setBar($bar)
    {
        $this->bar = $bar;
    }

    /**
     * @return Hunter
     */
    public function getHunter()
    {
        return $this->hunter;
    }

    /**
     * @param Hunter $hunter
     */
    public function setHunter($hunter)
    {
        $this->hunter = $hunter;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}