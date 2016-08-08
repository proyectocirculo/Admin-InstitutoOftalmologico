<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Circulo\VegaBundle\Block;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Admin\Pool;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Sonata\UserBundle\Model\UserInterface;
/**
 *
 * @author     Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class DashboardProfesionalesBlockService extends BaseBlockService
{
    protected $pool;
    /**
     * @var ProfileMenuBuilder
     */
    protected $securityContext;

    /**
     * @param string                                                     $name
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     * @param \Sonata\AdminBundle\Admin\Pool                             $pool
     * @param SecurityContextInterface                                   $securityContext     
     */
    public function __construct($name, EngineInterface $templating, Pool $pool,EntityManager $em, SecurityContextInterface $securityContext)
    {
        parent::__construct($name, $templating);

        $this->pool = $pool;
        $this->securityContext = $securityContext;

        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {

        $settings = $blockContext->getSettings();

        //$emConfig = $this->em->getConfiguration();
        //$emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
        //$emConfig->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');
        //$emConfig->addCustomDatetimeFunction('DAY', 'DoctrineExtensions\Query\Mysql\Day');
        $ultimos_pacientes = null;
        $ultimas_atenciones = null;
        $ultimas_practicas = null;
        $ultimas_atenciones_terminadas = null;
        $ultimas_practicas_terminadas = null;

        $user = false;
        if ($this->securityContext->getToken()) {
            $user = $this->securityContext->getToken()->getUser();
        }
        
        //throw new \RuntimeException(' user->getMedico() ' . $user->getMedico());
        if (!$user instanceof UserInterface) {
            $user = false;
        }else
        {
            if ($user->getMedico()) {
                //QUERY
                $query = $this->em->createQuery('SELECT p
                            FROM VegaBundle:Pacientes p
                            JOIN p.medicocabecera m
                            WHERE m.id = :este_medico
                            ');//->setMaxResults(15);  
                //$query->setParameter('este_mes', date('m'));  
                //$query->setParameter('este_anio', date('y'));
                $query->setParameter('este_medico', $user->getMedico());

                //RESULTADO
                $ultimos_pacientes = $query->getResult();

                $query = $this->em->createQuery('SELECT a
                            FROM VegaBundle:Atenciones a
                            WHERE a.medico = :este_medico
                            AND (a.terminada = 0 OR a.terminada is null)
                            ORDER BY a.fecha DESC');//->setMaxResults(15);  
                $query->setParameter('este_medico', $user->getMedico()); 

                //RESULTADO                
                $ultimas_atenciones = $query->getResult();

                $query = $this->em->createQuery('SELECT p
                            FROM VegaBundle:Practicas p
                            JOIN p.atencion a
                            WHERE a.medico = :este_medico
                            AND (a.terminada = 0 OR a.terminada is null)
                            ORDER BY a.fecha DESC');//->setMaxResults(15);  
                $query->setParameter('este_medico', $user->getMedico()); 

                //RESULTADO
                $ultimas_practicas = $query->getResult();


                $query = $this->em->createQuery('SELECT a
                            FROM VegaBundle:Atenciones a
                            WHERE a.medico = :este_medico
                            AND (a.terminada = 1)
                            ORDER BY a.fecha DESC');//->setMaxResults(15);  
                $query->setParameter('este_medico', $user->getMedico()); 

                //RESULTADO                
                $ultimas_atenciones_terminadas = $query->getResult();

                $query = $this->em->createQuery('SELECT p
                            FROM VegaBundle:Practicas p
                            JOIN p.atencion a
                            WHERE a.medico = :este_medico
                            AND (a.terminada = 1)
                            ORDER BY a.fecha DESC');//->setMaxResults(15);  
                $query->setParameter('este_medico', $user->getMedico()); 

                //RESULTADO
                $ultimas_practicas_terminadas = $query->getResult();
            }
        }
        
     



        return $this->renderResponse($blockContext->getTemplate(), array(
            'ultimos_pacientes'     => $ultimos_pacientes,
            'ultimas_atenciones'     => $ultimas_atenciones,
            'ultimas_practicas'     => $ultimas_practicas,
            'ultimas_atenciones_terminadas'     => $ultimas_atenciones_terminadas,
            'ultimas_practicas_terminadas'     => $ultimas_practicas_terminadas,
            'block'     => $blockContext->getBlock(),
            'settings'  => $settings
        ), $response);
    }



    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Profesionales';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'title'    => 'ULTIMAS ACTIVIDADES',
            'template' => 'VegaBundle:Block:dashboard_profesionales.html.twig',
        ));
    }


}