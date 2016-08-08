<?php
// /src/Acme/DemoBundle/Controller/MediaCRUDController.php
namespace Bitsmkt\VegaBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Bitsmkt\VegaBundle\Entity\Practicas;

class AtencionesCRUDController extends CRUDController
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

        return $this->render('VegaBundle:Frontend:atenciones_por_pacientes.html.twig', array(
            'action'     => 'list',
            'form'       => $formView,
            'datagrid'   => $datagrid,
            'csrf_token' => $this->getCsrfToken('sonata.batch'),
        ));

        
    }


    /**
     * return the Response object associated to the create action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function createAction()
    {
        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->getRestMethod()== 'POST') {
            $form->bind($this->get('request'));

            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                $this->admin->create($object);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                        'result' => 'ok',
                        'objectId' => $this->admin->getNormalizedIdentifier($object)
                    ));
                }


                /* CREO LOS COBROS 

                $em = $this->getDoctrine()->getManager();

                for ($i=1; $i <= $object->getCuotas(); $i++) { 
                    $nuevo_cobro = new Practicas();
                    $nuevo_cobro->setPrestamo($object);
                    $nuevo_cobro->setCuota($i);
                    $nuevo_cobro->setMontoAcobrar($object->getMontoCuota());
                    $nuevo_cobro->setFecha(new \DateTime('now'));
                    $nuevo_cobro->setCobrador($object->getPaciente()->getZona()->getCobradores()[0]);

                    $em->persist($nuevo_cobro);
                }

                $em->flush();
                */
                $this->addFlash('sonata_flash_success', $this->admin->trans('flash_create_success', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));

                // redirect to edit mode
                return $this->redirectTo($object);
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash('sonata_flash_error', $this->admin->trans('flash_create_error', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));
                }
            } elseif ($this->isPreviewRequested()) {
                // pick the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'create',
            'form'   => $view,
            'object' => $object,
        ));
    }

}