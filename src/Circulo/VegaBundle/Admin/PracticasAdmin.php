<?php

namespace Circulo\VegaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;

class PracticasAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->parentAssociationMapping = 'atencion';
    }
        
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('id')
            ->add('atencion')
            ->add('fecha')
            ->add('fechaRealizada')
            ->add('informacion')
            ->add('realizada')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->add('atencion')
            ->add('fecha')
            ->add('fechaRealizada')
            ->add('imagen',null,array('label'=>'Adjunto','template' => 'VegaBundle:Campos:preview_adjunto_list.html.twig'))

            ->add('realizada')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
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
            ->add('atencion')
            ->add('fecha','date', 
                array(
                'label' => 'Fecha pactada',
                'widget' => 'choice',
                // this is actually the default format for single_text
                'format' => 'dd MM yyyy',
                'data' =>  new \DateTime('now')
                ))
            ->add('fechaRealizada','date', 
                array(
                'widget' => 'choice',
                // this is actually the default format for single_text
                'format' => 'dd MM yyyy',
                'data' =>  new \DateTime('now')
                ))
            ->add('informacion','textarea',array('label'=>'Información','required'=>false))
            ->add('imagen', 'sonata_type_model_list', array(
                    'required' => false,
                    'label' => 'Adjuntar archivo',
                ), array(
                    'link_parameters' => array(
                        'context'  => 'practicas',
                        'filter'   => array('context' => array('value' => 'practicas')),
                        'provider' => ''
                    )
                ))
            ->add('realizada')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('atencion')
            ->add('fecha')
            ->add('fechaRealizada')
            ->add('informacion')
            ->add('imagen',null,array('label'=>'Archivo Adjunto'))
        ;
    }
}
