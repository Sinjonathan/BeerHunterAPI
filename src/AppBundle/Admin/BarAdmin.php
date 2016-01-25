<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class BarAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text');
        $formMapper->add('description', 'textarea', array('required' => false));
        $formMapper->add('longitude', 'number', array('scale' => 12));
        $formMapper->add('latitude', 'number', array('scale' => 12));
        $formMapper->add('address', 'sonata_type_model', array('class' => 'AppBundle\Entity\Address',));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('description');
        $listMapper->addIdentifier('longitude');
        $listMapper->addIdentifier('latitude');
        $listMapper->addIdentifier('address');
        $listMapper->addIdentifier('hunts');
    }
}