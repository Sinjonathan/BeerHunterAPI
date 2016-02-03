<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class BarAdmin
 * @package AppBundle\Admin
 */
class BarAdmin extends Admin
{
    /**
     * Configure the fields available in the edition and creation page
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text');
        $formMapper->add('description', 'textarea', array('required' => false));
        $formMapper->add('longitude', 'number', array('scale' => 12));
        $formMapper->add('latitude', 'number', array('scale' => 12));
        $formMapper->add('address', 'text');
        $formMapper->add('city','text');
        $formMapper->add('postal','number');
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
        $listMapper->addIdentifier('description');
        $listMapper->addIdentifier('longitude');
        $listMapper->addIdentifier('latitude');
        $listMapper->addIdentifier('address');
        $listMapper->addIdentifier('city');
        $listMapper->addIdentifier('postal');
        $listMapper->addIdentifier('hunts');
    }
}