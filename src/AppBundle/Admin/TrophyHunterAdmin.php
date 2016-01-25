<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TrophyHunterAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('unlockDate', 'date');
        $formMapper->add('trophy', 'sonata_type_model', array('class' => 'AppBundle\Entity\Trophy'));
        $formMapper->add('hunter', 'entity', array('class' => 'AppBundle\Entity\Hunter'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('unlockDate');
        $listMapper->addIdentifier('trophy');
        $listMapper->addIdentifier('hunter');
    }
}