<?php

namespace Circulo\VegaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SistemaController extends Controller
{
    public function panelAction()
    {
        return $this->render('VegaBundle:Sistema:panel.html.twig');
    }
}
