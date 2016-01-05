<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The link with additional attributes between Hunter and Trophy.
 *
 * @ORM\Entity
 * @ORM\Table(name="trophy_hunter")
 */
class TrophyHunter
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
     * @var \DateTime Date of unlock.
     *
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date
     */
    protected $unlockDate;

    /**
     * @var Trophy The trophy unlocked.
     *
     * @ORM\ManyToOne(targetEntity="Trophy", inversedBy="trophyHunter")
     * @ORM\JoinColumn(name="trophy_id", referencedColumnName="id")
     * */
    protected $trophy;

    /**
     * @var Hunter The hunter who unlock the trophy.
     *
     * @ORM\ManyToOne(targetEntity="Hunter", inversedBy="trophyHunter")
     * @ORM\JoinColumn(name="hunter_id", referencedColumnName="id")
     * */
    protected $hunter;

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
    public function getUnlockDate()
    {
        return $this->unlockDate;
    }

    /**
     * @param \DateTime $unlockDate
     */
    public function setUnlockDate($unlockDate)
    {
        $this->unlockDate = $unlockDate;
    }

    /**
     * @return mixed
     */
    public function getTrophy()
    {
        return $this->trophy;
    }

    /**
     * @param mixed $trophy
     */
    public function setTrophy($trophy)
    {
        $this->trophy = $trophy;
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
}