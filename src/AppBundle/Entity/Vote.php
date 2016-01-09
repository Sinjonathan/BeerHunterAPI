<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A vote.
 *
 * @ORM\Entity
 * @ORM\Table(name="vote")
 */
class Vote
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
     * @var \DateTime Date of the vote.
     *
     * @ORM\Column(type="date", nullable=false)
     * @Assert\Date
     */
    protected $dateVote;

    /**
     * @var boolean The result of the vote. Is true/false, the beer is(not) in the bar.
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $vote;

    /**
     * @var Hunt The hunt for that the hunter vote.
     *
     * @ORM\ManyToOne(targetEntity="Hunt", inversedBy="votes", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="hunt_id", referencedColumnName="id")
     * */
    protected $hunt;

    /**
     * @var Hunter The hunter who voted.
     *
     * @ORM\ManyToOne(targetEntity="Hunter", inversedBy="votes", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="hunter_id", referencedColumnName="id")
     */
    protected $hunter;

    public function __construct()
    {
        $this->dateVote = new \DateTime();
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
    public function getDateVote()
    {
        return $this->dateVote;
    }

    /**
     * @param \DateTime $dateVote
     */
    public function setDateVote($dateVote)
    {
        $this->dateVote = $dateVote;
    }

    /**
     * @return boolean
     */
    public function isVote()
    {
        return $this->vote;
    }

    /**
     * @param boolean $vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;
    }

    /**
     * @return Hunt
     */
    public function getHunt()
    {
        return $this->hunt;
    }

    /**
     * @param Hunt $hunt
     */
    public function setHunt($hunt)
    {
        $this->hunt = $hunt;
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

    public function __toString()
    {
        return $this->id . '';
    }
}