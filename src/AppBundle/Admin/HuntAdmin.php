<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class HuntAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('launchDate', 'date');
        $formMapper->add('isPressure', 'checkbox', array('required' => false));
        $formMapper->add('balance', 'integer');
        $formMapper->add('beer', 'entity', array('class' => 'AppBundle\Entity\Beer'));
        $formMapper->add('bar', 'entity', array('class' => 'AppBundle\Entity\Bar'));
        $formMapper->add('hunter', 'entity', array('class' => 'AppBundle\Entity\Hunter'));
        $formMapper->add('status', 'integer');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('isPressure');
        $listMapper->addIdentifier('date');
        $listMapper->addIdentifier('balance');
        $listMapper->addIdentifier('beer');
        $listMapper->addIdentifier('bar');
        $listMapper->addIdentifier('hunter');
        $listMapper->addIdentifier('votes');
        $listMapper->addIdentifier('status');
    }
}