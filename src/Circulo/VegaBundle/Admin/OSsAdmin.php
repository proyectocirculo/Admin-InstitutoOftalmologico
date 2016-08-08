<?php

namespace Circulo\VegaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;

class OSsAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        // show link only on edit and show
        if (!$childAdmin && !in_array($action, array('edit','show'))) {
            return;
        }
        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');


        $menu->addChild(
            'Pacientes',
            array('uri' => $this->getChild('vega.admin.pacientes')->generateUrl('list', array('id' => $id)))
            //array('uri' => $admin->generateUrl('financiera.admin.prestamos.list', array('id' => $id)))
        );

      
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('id',null,array('label'=>'CODIGO'))
            ->add('nombre')
            ->add('codigo')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
           //->add('id',null,array('label'=>'CODIGO'))
            ->add('nombre')
            ->add('codigo')
            //->add('localidad','entity',array('class'=>'VegaBundle:Localidades','property'=>'localidad'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'pacientes' => array(
                        'template' => 'VegaBundle:CRUD:list__action_pacientes.html.twig'
                    ),

                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            //->add('id')
            ->add('nombre')
            ->add('codigo')
            //->add('localidad','entity',array('class'=>'VegaBundle:Localidades','property'=>'localidad'))

        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            //->add('id')
            ->add('nombre')
            ->add('codigo')
        ;
    }
}
