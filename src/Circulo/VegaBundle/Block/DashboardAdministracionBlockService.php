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

/**
 *
 * @author     Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class DashboardAdministracionBlockService extends BaseBlockService
{
    protected $pool;

    /**
     * @param string                                                     $name
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     * @param \Sonata\AdminBundle\Admin\Pool                             $pool
     */
    public function __construct($name, EngineInterface $templating, Pool $pool,EntityManager $em)
    {
        parent::__construct($name, $templating);

        $this->pool = $pool;
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
    
        //QUERY
        $query = $this->em->createQuery('SELECT p
                    FROM VegaBundle:Pacientes p
                    WHERE p.fecha_alta > :este_mes
                    ORDER BY p.fecha_alta DESC');//->setMaxResults(15);  
        //$query->setParameter('este_mes', date('m'));  
        //$query->setParameter('este_anio', date('y'));
        $query->setParameter('este_mes', new \DateTime('-1 month'));

        //RESULTADO
        $ultimos_pacientes = $query->getResult();

        $query = $this->em->createQuery('SELECT a
                    FROM VegaBundle:Atenciones a
                    WHERE a.fecha > :este_mes
                    ORDER BY a.fecha DESC');//->setMaxResults(15);  
        //$query->setParameter('este_mes', date('m'));
        //$query->setParameter('este_anio', date('y'));  
        $query->setParameter('este_mes', new \DateTime('-1 month'));

        //RESULTADO
        $ultimas_atenciones = $query->getResult();

        $query = $this->em->createQuery('SELECT p
                    FROM VegaBundle:Practicas p
                    ORDER BY p.fecha DESC');//->setMaxResults(15);  

        //RESULTADO
        $ultimas_practicas = $query->getResult();


        return $this->renderResponse($blockContext->getTemplate(), array(
            'ultimos_pacientes'     => $ultimos_pacientes,
            'ultimas_atenciones'     => $ultimas_atenciones,
            'ultimas_practicas'     => $ultimas_practicas,
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
        return 'Administracion';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'title'    => 'ULTIMAS ACTIVIDADES',
            'template' => 'VegaBundle:Block:dashboard_administracion.html.twig',
        ));
    }


}