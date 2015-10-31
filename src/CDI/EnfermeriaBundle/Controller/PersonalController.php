<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Personal;
use CDI\EnfermeriaBundle\Form\PersonalType;

/**
 * Personal controller.
 *
 * @Route("/personal")
 */
class PersonalController extends Controller {

    /**
     * Lists all Personal entities.
     *
     * @Route("/", name="personal")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }


        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('EnfermeriaBundle:Personal')->findAll();


        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Personal entity.
     *
     * @Route("/", name="personal_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:Personal:new.html.twig")
     */
    public function createAction(Request $request) {
      
        //var_dump($request);die;
        $var = $request->request->get('cdi_enfermeriabundle_personal');
        $cedula = $var['datos']['cedula'];

        //var_dump($cedula);die;

        $em = $this->getDoctrine()->getManager();
        $entity_datos = $em->getRepository('EnfermeriaBundle:Datos')->findByCedula($cedula);
        $agregarPersonal = false;
        //echo count($entity_datos);die();
        if (count($entity_datos) > 0) {
            $entity_personal = $em->getRepository('EnfermeriaBundle:Personal')->findByDatos($entity_datos[0]->getId());
            if (!$entity_personal)
                $agregarPersonal = true;
        } else {
            $agregarPersonal = true;
        }

        if ($agregarPersonal) {
            $entity = new Personal();
            $form = $this->createCreateForm($entity);
            $form->handleRequest($request);

            $nombres = $entity->getDatos()->getNombres();
            $nombres_minuscula = strtolower($nombres);
            $nombres_capital = ucwords($nombres_minuscula);
            $entity->getDatos()->setNombres($nombres_capital);

            $apellidos = $entity->getDatos()->getApellidos();
            $apellidos_minuscula = strtolower($apellidos);
            $apellidos_capital = ucwords($apellidos_minuscula);
            $entity->getDatos()->setApellidos($apellidos_capital);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                //Verificar que si el personal esta registrado en Datos                                
                $entity_datos = $em->getRepository('EnfermeriaBundle:Datos')->findByCedula($cedula);

                //si el personal esta en datos entonces uso esos datos si no el los crea
                if (count($entity_datos) == 1) {
                    $entity->setDatos($entity_datos[0]);
                }

                $em->persist($entity);
                $em->flush();
                // Registramos la accion en la auditoria
                $this->forward("EnfermeriaBundle:Auditoria:registrar", array('accion' => "insertar", 'entidad' => "personal", 'entidadId' => $entity->getId()));
            }

            return $this->redirect($this->generateUrl('personal_show', array('id' => $entity->getId())));
        }

        return $this->redirect($this->generateUrl('personal'));
    }

    /**
     * Creates a form to create a Personal entity.
     *
     * @param Personal $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Personal $entity) {
      
        $form = $this->createForm(new PersonalType(), $entity, array(
            'action' => $this->generateUrl('personal_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Personal entity.
     *
     * @Route("/new", name="personal_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
       
        $entity = new Personal();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Personal entity.
     *
     * @Route("/{id}", name="personal_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
   
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Personal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Personal entity.
     *
     * @Route("/{id}/edit", name="personal_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Personal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personal entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Personal entity.
     *
     * @param Personal $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Personal $entity) {
     
        $form = $this->createForm(new PersonalType(), $entity, array(
            'action' => $this->generateUrl('personal_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }

    /**
     * Edits an existing Personal entity.
     *
     * @Route("/{id}", name="personal_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:Personal:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
       

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Personal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);


        $nombres = $entity->getDatos()->getNombres();
        $nombres_minuscula = strtolower($nombres);
        $nombres_capital = ucwords($nombres_minuscula);
        $entity->getDatos()->setNombres($nombres_capital);

        $apellidos = $entity->getDatos()->getApellidos();
        $apellidos_minuscula = strtolower($apellidos);
        $apellidos_capital = ucwords($apellidos_minuscula);
        $entity->getDatos()->setApellidos($apellidos_capital);

        if ($editForm->isValid()) {
            $em->flush();
            // Registramos la accion en la auditoria
            $this->forward("EnfermeriaBundle:Auditoria:registrar", array('accion' => "modificar", 'entidad' => "personal", 'entidadId' => $entity->getId()));

            return $this->redirect($this->generateUrl('personal', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Personal entity.
     *
     * @Route("/{id}", name="personal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
       
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:Personal')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Personal entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('personal'));
    }

    /**
     * Creates a form to delete a Personal entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('personal_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
