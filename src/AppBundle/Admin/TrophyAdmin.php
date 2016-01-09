<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TrophyAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('label', 'text');
        $formMapper->add('description', 'textarea');
        //$formMapper->add('trophyHunter', 'entity', array('class' => 'AppBundle\Entity\TrophyHunter', 'property' => 'name',));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('label');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('label');
        $listMapper->addIdentifier('description');
        //$listMapper->addIdentifier('trophyHunter');
    }
}