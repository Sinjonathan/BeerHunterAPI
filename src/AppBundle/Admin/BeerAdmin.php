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
        $formMapper->add('color', 'entity', array('class' => 'AppBundle\Entity\Color', 'property' => 'name',));
        //$formMapper->add('degree', 'integer', array('scale' => 2));
        $formMapper->add('description', 'textarea', array('required' => false));
        $formMapper->add('origin', 'entity', array('class' => 'AppBundle\Entity\Country', 'property' => 'name',));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }
}