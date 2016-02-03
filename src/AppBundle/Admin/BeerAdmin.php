<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class BeerAdmin
 * @package AppBundle\Admin
 */
class BeerAdmin extends Admin
{
    /**
     * Configure the fields available in the edition and creation page
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text');
        $formMapper->add('color', 'sonata_type_model', array('class' => 'AppBundle\Entity\Color'));
        $formMapper->add('degree', 'number', array('scale' => 2));
        $formMapper->add('description', 'textarea', array('required' => false));
        $formMapper->add('origin', 'sonata_type_model', array('class' => 'AppBundle\Entity\Country'));
    }

    /**
     * Configure all the filter available
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    /**
     * Configure the fields available in the list view
     * @param ListMapper $listMapper
     */
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