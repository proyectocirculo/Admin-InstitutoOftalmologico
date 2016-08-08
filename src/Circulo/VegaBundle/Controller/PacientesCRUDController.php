<?php
// /src/Acme/DemoBundle/Controller/MediaCRUDController.php
namespace Bitsmkt\VegaBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

class PacientesCRUDController extends CRUDController
{
    public function transaccionesAction($id = null)
    {
        //throw new \RuntimeException('The Request object has not been set ' . $id);

        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }
        $id = $this->get('request')->get($this->admin->getIdParameter());

        if ($id == '*') {
            # TODOS - Viene de Dashboard

        }else
        {

            $object = $this->admin->getObject($id);

            if (!$object) {
                throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
            }

            $this->admin->setSubject($object);            
        }

        
        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render('VegaBundle:Frontend:atenciones_clientes.html.twig', array(
            'action'     => 'list',
            'form'       => $formView,
            'datagrid'   => $datagrid,
            'csrf_token' => $this->getCsrfToken('sonata.batch'),
        ));

        
    }
}