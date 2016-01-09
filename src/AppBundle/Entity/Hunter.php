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
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email.",checkMX = true))
     */
    protected $email;

    /**
     * @var boolean
     *
         * @ORM\Column(type="boolean", nullable=true)
     */
    protected $enabled;

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

    /**
     * @var ArrayCollection The link of belonging with additional attributes between Hunter and Trophy.
     *
     * @ORM\OneToMany(targetEntity="TrophyHunter", mappedBy="hunter")
     * */
    protected $trophyHunter;

    /**
     * @var ArrayCollection The link of vote with additional attributes between Hunter and Hunt.
     *
     * @ORM\OneToMany(targetEntity="Vote", mappedBy="hunter")
     * */
    protected $votes;


    // Overrides to fix Nelmio Api Doc
    protected $groups;

    public function __construct()
    {
        parent::__construct();
        $this->hunts = new ArrayCollection();
        $this->trophyHunter = new ArrayCollection();
        $this->votes = new ArrayCollection();
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

    /**
     * @return ArrayCollection
     */
    public function getTrophyHunter()
    {
        return $this->trophyHunter;
    }

    /**
     * @param ArrayCollection $trophyHunter
     */
    public function setTrophyHunter($trophyHunter)
    {
        $this->trophyHunter = $trophyHunter;
    }

    /**
     * @return ArrayCollection
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param ArrayCollection $votes
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;
    }
}