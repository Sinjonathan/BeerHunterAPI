<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class HunterRepository extends EntityRepository
{
    public function findTop()
    {
        return $this->findBy(array(), array('weeklyScore' => 'DESC'),10);
    }
}