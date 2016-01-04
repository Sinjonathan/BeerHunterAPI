<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User;

/**
 * A hunter.
 *
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class Hunter extends User
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
     * @var int The potential score of the hunter if all his active hunt are accepted.
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $potentialScore = 0;

    /**
     * @var int The actual score of the hunter.
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $validScore = 0;

    /**
     * @var int The weekly valid score of the hunter.
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $weeklyScore = 0;

    /**
     * @var ArrayCollection The hunts of the hunter.
     *
     * @ORM\OneToMany(targetEntity="Hunt", mappedBy="hunter")
     */
    protected $hunts;

    public function __construct()
    {
        parent::__construct();
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
     * @return int
     */
    public function getPotentialScore()
    {
        return $this->potentialScore;
    }

    /**
     * @param int $potentialScore
     */
    public function setPotentialScore($potentialScore)
    {
        $this->potentialScore = $potentialScore;
    }

    /**
     * @return int
     */
    public function getValidScore()
    {
        return $this->validScore;
    }

    /**
     * @param int $validScore
     */
    public function setValidScore($validScore)
    {
        $this->validScore = $validScore;
    }

    /**
     * @return int
     */
    public function getWeeklyScore()
    {
        return $this->weeklyScore;
    }

    /**
     * @param int $weeklyScore
     */
    public function setWeeklyScore($weeklyScore)
    {
        $this->weeklyScore = $weeklyScore;
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