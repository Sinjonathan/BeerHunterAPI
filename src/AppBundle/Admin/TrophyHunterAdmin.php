<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class TrophyHunterAdmin
 * @package AppBundle\Admin
 */
class TrophyHunterAdmin extends Admin
{
    /**
     * Configure the fields available in the edition and creation page
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('unlockDate', 'date');
        $formMapper->add('trophy', 'sonata_type_model', array('class' => 'AppBundle\Entity\Trophy'));
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
        $listMapper->addIdentifier('unlockDate');
        $listMapper->addIdentifier('trophy');
        $listMapper->addIdentifier('hunter');
    }
}