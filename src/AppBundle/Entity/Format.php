<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A format of beer.
 *
 * @ORM\Entity
 * @ORM\Table(name="format")
 */
class Format
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
     * @var string A volume of bottle (ex : "70CL").
     *
     * @ORM\Column(type="string", length=5, unique=true, nullable=false)
     */
    protected $volume;
}