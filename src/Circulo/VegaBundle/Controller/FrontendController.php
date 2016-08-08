<?php

namespace Circulo\VegaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontendController extends Controller
{
    public function indexAction()
    {
        //return $this->render('VegaBundle:Frontend:index.html.twig');
        return $this->redirectToRoute('sonata_admin_dashboard');
    }
}
