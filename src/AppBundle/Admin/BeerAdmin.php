<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class BeerAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text');
        $formMapper->add('color', 'entity', array('class' => 'AppBundle\Entity\Color'));
        $formMapper->add('degree', 'number', array('scale' => 2));
        $formMapper->add('description', 'textarea', array('required' => false));
        $formMapper->add('origin', 'sonata_type_model', array('class' => 'AppBundle\Entity\Country'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('color');
        $listMapper->addIdentifier('degree');
        $listMapper->addIdentifier('description');
        $listMapper->addIdentifier('origin');
        $listMapper->addIdentifier('hunts');
    }
}