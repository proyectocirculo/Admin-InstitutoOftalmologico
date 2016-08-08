<?php

namespace Circulo\VegaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Circulo\VegaBundle\Entity\Practicas as Practicas;

use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;

class AtencionesAdmin extends Admin
{

    /**
     * {@inheritdoc}
    */
    public function configure()
    {
        
        //$this->parentAssociationMapping = 'medico';
        $this->parentAssociationMapping = 'paciente';
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
            'Practicas',
            array('uri' => $this->getChild('vega.admin.practicas')->generateUrl('list', array('id' => $id)))
            //array('uri' => $admin->generateUrl('vega.admin.prestamos.list', array('id' => $id)))
        );
    }

    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('motivo')
            ->add('fecha')
            ->add('paciente')
            ->add('medico')
            ->add('terminada')


        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('fecha','date', 
                array(
                //'widget' => 'choice',
                // this is actually the default format for single_text
                'format' => 'd/m/Y',
                //'data' =>  new \DateTime('now')
                ))
            ->add('paciente')
            ->add('medico')
            ->add('motivo')
            ->add('terminada',null,array('label'=>'Terminada','editable' => true))
            ->add('nota_proxima_atencion')
            ->add('fecha_proxima_atencion','date', 
                        array(
                        'widget' => 'choice',
                        'required' => false,
                        'format' => 'd/m/Y',
                    ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                    'pacientes' => array(
                        'template' => 'VegaBundle:CRUD:list__action_atenciones_practicas.html.twig'
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

        

        $subject = $this->getSubject();


        
            //->add('id')
            //->add('paciente', 'entity', array('class'=>'VegaBundle:Pacientes', 'property' => 'codigo'))

            if ($subject->getId()) {
                //EDICION
                
                $formMapper
                ->add('paciente', 'sonata_type_model_list', array(
                        'required' => false,
                        'read_only' => true,//'attr'=>array('readonly' => true),
                        'label' => 'Paciente',
                    ))
                
                ->add('medico', 'entity', array(
                    //'read_only' => true,//'attr'=>array('readonly' => true),
                    'class'=>'VegaBundle:Medicos', 
                    'property' => 'nombre'))
                
                ->add('fecha','date', 
                    array(
                    'widget' => 'choice',
                    'read_only' => true,//'attr'=>array('readonly' => true),
                    // this is actually the default format for single_text
                    'format' => 'dd MM yyyy',
                    'data' =>  new \DateTime('now')
                    ))
                ->add('observaciones','textarea',array(
                    'label'=>'Observaciones',
                    'required'=>false));

                    
                if ($this->isgranted('ROLE_MEDICO')) {
                    $formMapper
                    ->add('motivo','textarea',array(
                    'label'=>'Motivo',
                    'required'=>false))
                    ->add('antecedentes','textarea',array(
                    'label'=>'Antecedentes',
                    'required'=>false))

                    ->add('agudeza_visual_SP','checkbox',array(
                        'label'=>'Agudeza visual SP',
                        'required'=>false))
                    ->add('agudeza_visual','textarea',array(
                        'label'=>'Agudeza visual',
                        'required'=>false))

                    ->add('sin_correccion_ojo_izquierdo','textarea',array(
                        'label'=>'Sin corrección ojo izquierdo',
                        'required'=>false))
                    ->add('sin_correccion_ojo_derecho','textarea',array(
                        'label'=>'Sin corrección ojo derecho',
                        'required'=>false))
                    ->add('con_correccion_ojo_izquierdo','textarea',array(
                        'label'=>'Con corrección ojo izquierdo',
                        'required'=>false))
                    ->add('con_correccion_ojo_derecho','textarea',array(
                        'label'=>'Con corrección ojo derecho',
                        'required'=>false))

                    ->add('tonometria_SP','checkbox',array(
                        'label'=>'Tonometría SP',
                        'required'=>false))
                    ->add('tonometria','textarea',array(
                        'label'=>'Tonometría',
                        'required'=>false))

                    ->add('biomicroscopia_SP','checkbox',array(
                        'label'=>'Biomicroscopia SP',
                        'required'=>false))
                    ->add('biomicroscopia','textarea',array(
                        'label'=>'Biomicroscopía',
                        'required'=>false))

                    ->add('fondo_ojo_SP','checkbox',array(
                        'label'=>'Fondo de ojo SP',
                        'required'=>false))
                    ->add('fondo_ojo','textarea',array(
                        'label'=>'Fondo de ojo',
                        'required'=>false))


                    ->add('terminada','checkbox',array(
                        'label'=>'Terminada',
                        'required'=>false))


                    ;
                }

                $formMapper
                ->add('nota_proxima_atencion','textarea',array(
                    'label'=>'Nota próxima atención',
                    'required'=>false))

                    ->add('fecha_proxima_atencion','date', 
                        array(
                        'widget' => 'choice',
                        'required' => false,
                        'read_only' => true,//'attr'=>array('readonly' => true),
                        // this is actually the default format for single_text
                        'format' => 'dd MM yyyy',
                        'data' =>  new \DateTime('now')
                    ))
                ;

            }else
            {
                //CREACION
                $formMapper
                ->add('paciente', 'sonata_type_model_list', array(
                        'required' => false,
                        'label' => 'Paciente',
                    ))
                ->add('medico', 'entity', array('class'=>'VegaBundle:Medicos', 'property' => 'nombre'))
                ->add('fecha','date', 
                    array(
                    'widget' => 'choice',
                    // this is actually the default format for single_text
                    'format' => 'dd MM yyyy',
                    'data' =>  new \DateTime('now')
                    ))
                ->add('observaciones','textarea',array('label'=>'Observaciones','required'=>false));
            }



    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('fecha')
            ->add('paciente')
            ->add('medico')
            ->add('motivo','textarea',array('label'=>'Motivo'))


            ->add('observaciones','textarea',array('label'=>'Observaciones'))
            ->add('nota_proxima_atencion')
            ->add('fecha_proxima_atencion','date', 
                        array(
                        'widget' => 'choice',
                        'required' => false,
                        'format' => 'd m Y',
                    ))
            ->add('terminada','checkbox',array(
                'label'=>'Terminada',
                'required'=>false))
        ;

   
        if ($this->isgranted('ROLE_MEDICO')) {

            $showMapper
            
            
            ->add('antecedentes','textarea',array(
            'label'=>'Antecedentes',
            'required'=>false))

            ->add('agudeza_visual_SP','checkbox',array(
                'label'=>'Agudeza visual SP',
                'required'=>false))
            ->add('agudeza_visual','textarea',array(
                'label'=>'Agudeza visual',
                'required'=>false))
            
            ->add('sin_correccion_ojo_izquierdo','textarea',array(
                'label'=>'Sin corrección ojo izquierdo',
                'required'=>false))
            ->add('sin_correccion_ojo_derecho','textarea',array(
                'label'=>'Sin corrección ojo derecho',
                'required'=>false))
            ->add('con_correccion_ojo_izquierdo','textarea',array(
                'label'=>'Con corrección ojo izquierdo',
                'required'=>false))
            ->add('con_correccion_ojo_derecho','textarea',array(
                'label'=>'Con corrección ojo derecho',
                'required'=>false))

            ->add('tonometria_SP','checkbox',array(
                'label'=>'Tonometría SP',
                'required'=>false))
            ->add('tonometria','textarea',array(
                'label'=>'Tonometría',
                'required'=>false))

            ->add('biomicroscopia_SP','checkbox',array(
                'label'=>'Biomicroscopia SP',
                'required'=>false))
            ->add('biomicroscopia','textarea',array(
                'label'=>'Biomicroscopía',
                'required'=>false))

            ->add('fondo_ojo_SP','checkbox',array(
                'label'=>'Fondo de ojo SP',
                'required'=>false))
            ->add('fondo_ojo','textarea',array(
                'label'=>'Fondo de ojo',
                'required'=>false))

            
            

            
            ;
        }      
          
    }



}
