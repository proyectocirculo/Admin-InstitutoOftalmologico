<?php

namespace Circulo\VegaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;

class PacientesAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->parentAssociationMapping = 'os';
    }

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
            'Atenciones',
            array('uri' => $this->getChild('vega.admin.atenciones')->generateUrl('list', array('id' => $id)))
        );
        
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('id')
            ->add('dni')
            ->add('codigo') 
            ->add('os',null,array('label'=>'Obra Social'))
            //->add('telefono')
            //->add('direccion')
            //->add('fecha_nacimiento')
            //->add('sexo')
            ->add('medicocabecera',null,array('label'=>'Médico de Cabecera'))
            //->add('celular')
            ->add('tags')
            ->add('localidad') 
                    
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->add('dni')
                ->add('nombre')
                ->add('apellido')  
                //->add('sexo')    
                //->add('fecha_nacimiento')  
                ->add('codigo')
                ->add('os',null,array('label'=>'Obra Social'))
                ->add('medicocabecera',null,array('label'=>'Médico de Cabecera'))

                //->add('direccion')
                //->add('telefono')
                //->add('celular')
                //->add('email')  
                ->add('tags',null,array('label'=>'Patologías'))

            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'atenciones' => array(
                        'template' => 'VegaBundle:CRUD:list__action_atenciones.html.twig'
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


            ->with('Ficha Personal')
                ->add('dni')
                ->add('nombre')
                ->add('apellido')  
                ->add('sexo','choice',array('choices'=>array('M'=>'Masculino','F'=>'Femenino')))    
                ->add('fecha_nacimiento','date', 
                    array(
                        'widget' => 'choice',
                        // this is actually the default format for single_text
                        'format' => 'dd MM yyyy',
                        'years' => range(1800,2020),
                        //'data' =>  new \DateTime('now')
                    ))                 
                ->add('codigo')
                ->add('os', 'sonata_type_model_list',array('label'=>'Obra Social'))
                ->add('medicocabecera', 'sonata_type_model_list',array('label'=>'Médico de Cabecera','required'=>false))
            ->end()

            ->with('Datos de Contacto')
                ->add('direccion')
                ->add('localidad') 
                ->add('telefono')
                ->add('celular')
                ->add('email')  

            ->end()
            ->with('Patologías')
                
                ->add('tags', 'sonata_type_model', array(
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true,
                ))

                

            ->end()            
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('dni')
            ->add('nombre')
            ->add('os',null,array('label'=>'Obra Social'))
            ->add('telefono')
            ->add('direccion')
            ->add('localidad') 
            ->add('fecha_nacimiento')
            ->add('sexo')
            ->add('observaciones')                        
        ;
    }

}
