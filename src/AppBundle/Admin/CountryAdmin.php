<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Validator\Constraints\Length;

class CountryAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text');
        $formMapper->add('short', 'text', array('constraints' => new Length(array('max' => 3))));
        $formMapper->add('cities', 'entity', array('class' => 'AppBundle\Entity\City', 'property' => 'name', 'required' => false ));
        $formMapper->add('beers', 'entity', array('class' => 'AppBundle\Entity\Beer', 'property' => 'name', 'required' => false ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('short');
        //$listMapper->addIdentifier('cities');
        $listMapper->addIdentifier('beers');
    }
}