<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A Trophy.
 *
 * @ORM\Entity
 * @ORM\Table(name="trophy")
 */
class Trophy
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
     * @var String The name of the trophy.
     *
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    protected $label;

    /**
     * @var String A short description about how unlock the trophy.
     *
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    protected $description;

    /**
     * @var ArrayCollection The link.
     *
     * @ORM\OneToMany(targetEntity="TrophyHunter" , mappedBy="trophy" , cascade={"all"})
     * */
    protected $trophyHunter;

    public function __construct()
    {
        $this->trophyHunter = new ArrayCollection();
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
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param String $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
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
}