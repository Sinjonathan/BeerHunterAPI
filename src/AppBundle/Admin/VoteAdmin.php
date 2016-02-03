<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class VoteAdmin
 * @package AppBundle\Admin
 */
class VoteAdmin extends Admin
{
    /**
     * Configure the fields available in the edition and creation page
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('dateVote', 'date');
        $formMapper->add('vote', 'checkbox', array('required' => false));
        $formMapper->add('hunt', 'entity', array('class' => 'AppBundle\Entity\Hunt',));
        $formMapper->add('hunter', 'entity', array('class' => 'AppBundle\Entity\Hunter'));
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
        $listMapper->addIdentifier('dateVote');
        $listMapper->addIdentifier('vote');
        $listMapper->addIdentifier('hunt');
        $listMapper->addIdentifier('hunter');
    }
}