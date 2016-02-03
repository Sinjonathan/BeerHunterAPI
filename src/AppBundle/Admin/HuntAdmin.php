<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class HuntAdmin
 * @package AppBundle\Admin
 */
class HuntAdmin extends Admin
{
    /**
     * Configure the fields available in the edition and creation page
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('launchDate', 'date');
        $formMapper->add('isPressure', 'checkbox', array('required' => false));
        $formMapper->add('balance', 'integer');
        $formMapper->add('price', 'number', array('scale' => 2));
        $formMapper->add('beer', 'sonata_type_model', array('class' => 'AppBundle\Entity\Beer'));
        $formMapper->add('bar', 'sonata_type_model', array('class' => 'AppBundle\Entity\Bar'));
        $formMapper->add('hunter', 'entity', array('class' => 'AppBundle\Entity\Hunter'));
        $formMapper->add('status', 'integer');
    }

    /**
     * Configure all the filter available
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
    }

    /**
     * Configure the fields available in the list view
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('isPressure');
        $listMapper->addIdentifier('launchDate');
        $listMapper->addIdentifier('price');
        $listMapper->addIdentifier('balance');
        $listMapper->addIdentifier('beer');
        $listMapper->addIdentifier('bar');
        $listMapper->addIdentifier('hunter');
        $listMapper->addIdentifier('votes');
        $listMapper->addIdentifier('status');
    }
}