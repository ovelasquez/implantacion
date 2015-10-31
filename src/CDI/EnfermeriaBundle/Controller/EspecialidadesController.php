<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Especialidades;
use CDI\EnfermeriaBundle\Form\EspecialidadesType;


/**
 * Especialidades controller.
 *
 * @Route("/especialidades")
 */
class EspecialidadesController extends Controller {

    /**
     * Lists all Especialidades entities.
     * 
     * @Route("/", name="especialidades")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
       

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('EnfermeriaBundle:Especialidades')->findAll();


       return array(
            'entities' => $entities,
        );
    }  
    
    

    /**
     * Creates a new Especialidades entity.
     *
     * @Route("/", name="especialidades_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:Especialidades:new.html.twig")
     */
    public function createAction(Request $request) {      
        $entity = new Especialidades();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $nombre = $entity->getNombre();
        $nombre_minuscula = strtolower($nombre);
        $descripcion = ucwords($nombre_minuscula);
        $entity->setNombre($descripcion);

        if ($form->isValid()) {         
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);  
            $em->flush();
            // Registramos la accion en la auditoria
            $this->forward("EnfermeriaBundle:Auditoria:registrar", array('accion' => "insertar", 'entidad' => "especialidades", 'entidadId' => $entity->getId()));            
            return $this->redirect($this->generateUrl('especialidades_show', array('id' => $entity->getId())));
        }
        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Especialidades entity.
     *
     * @param Especialidades $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Especialidades $entity) {       
        $form = $this->createForm(new EspecialidadesType(), $entity, array(
            'action' => $this->generateUrl('especialidades_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));
        return $form;
    }

    /**
     * Displays a form to create a new Especialidades entity.
     *
     * @Route("/new", name="especialidades_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {

        $entity = new Especialidades();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Especialidades entity.
     *
     * @Route("/{id}", name="especialidades_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Especialidades')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especialidades entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Especialidades entity.
     *
     * @Route("/{id}/edit", name="especialidades_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Especialidades')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especialidades entity.');
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
     * Creates a form to edit a Especialidades entity.
     *
     * @param Especialidades $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Especialidades $entity) {

        $form = $this->createForm(new EspecialidadesType(), $entity, array(
            'action' => $this->generateUrl('especialidades_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }

    /**
     * Edits an existing Especialidades entity.
     *
     * @Route("/{id}", name="especialidades_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:Especialidades:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Especialidades')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especialidades entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);


        $nombre = $entity->getNombre();
        $nombre_minuscula = strtolower($nombre);
        $descripcion = ucwords($nombre_minuscula);
        $entity->setNombre($descripcion);


        if ($editForm->isValid()) {
            $em->flush();
            // Registramos la accion en la auditoria
                    $this->forward("EnfermeriaBundle:Auditoria:registrar", array('accion' => "modificar", 'entidad' => "especialidades", 'entidadId' => $entity->getId()));
            return $this->redirect($this->generateUrl('especialidades'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Especialidades entity.
     *
     * @Route("/{id}", name="especialidades_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:Especialidades')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Especialidades entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('especialidades'));
    }

    /**
     * Creates a form to delete a Especialidades entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('especialidades_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Eliminar', 'attr' => array('class' => 'btn')))
                        ->getForm()
        ;
    }

}