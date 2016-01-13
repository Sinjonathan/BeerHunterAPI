<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class HunterAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('username', 'text');
        $formMapper->add('email', 'text');
        $formMapper->add('plainPassword', 'text');
        $formMapper->add('enabled', 'checkbox', array('required' => false));
        $formMapper->add('potentialScore', 'integer');
        $formMapper->add('validScore', 'integer');
        $formMapper->add('weeklyScore', 'integer');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('username');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->add('username');
        //Up$listMapper->add('password');
        $listMapper->add('email');
        $listMapper->add('enabled');
        $listMapper->add('online');
        $listMapper->add('potentialScore');
        $listMapper->add('validScore');
        $listMapper->add('weeklyScore');
        $listMapper->add('hunts');
        $listMapper->add('votes');
        $listMapper->add('trophyHunter');
    }
}