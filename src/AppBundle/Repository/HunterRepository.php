<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class HunterRepository
 * @package AppBundle\Repository
 */
class HunterRepository extends EntityRepository
{
    /**
     * Return the ten best hunter according to there weeklyScore
     *
     * @return array
     */
    public function findTop()
    {
        return $this->findBy(array(), array('weeklyScore' => 'DESC'),10);
    }
}