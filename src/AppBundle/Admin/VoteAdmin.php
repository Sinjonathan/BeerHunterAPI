<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class VoteAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('dateVote', 'date');
        $formMapper->add('vote', 'checkbox', array('required' => false));
        $formMapper->add('hunt', 'entity', array('class' => 'AppBundle\Entity\Hunt',));
        $formMapper->add('hunter', 'entity', array('class' => 'AppBundle\Entity\Hunter'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('dateVote');
        $listMapper->addIdentifier('vote');
        $listMapper->addIdentifier('hunt');
        $listMapper->addIdentifier('hunter');
    }
}