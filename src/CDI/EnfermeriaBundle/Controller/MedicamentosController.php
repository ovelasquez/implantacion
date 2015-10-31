<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Medicamentos;
use CDI\EnfermeriaBundle\Form\MedicamentosType;

/**
 * Medicamentos controller.
 *
 * @Route("/medicamentos")
 */
class MedicamentosController extends Controller {

    /**
     * Lists all Medicamentos entities.
     *
     * @Route("/", name="medicamentos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('EnfermeriaBundle:Medicamentos')->findAll();


       return array(
            'entities' => $entities,
        );
//        $em = $this->getDoctrine()->getManager();
//        $mi_query = $em->getRepository('EnfermeriaBundle:Medicamentos')->findAll();
//
//        // Añadimos el paginador (En este caso el parámetro "1" es la página actual, y parámetro "5" es el número de registros a mostrar)
//        $paginator = $this->get('knp_paginator');
//        $pagination = $paginator->paginate(
//                $mi_query, $this->get('request')->query->get('page', 1), 5);
//
//        // Añadimos el parámetro a la plantilla
//        return $this->render('EnfermeriaBundle:Medicamentos:index.html.twig', array('pagination' => $pagination));
    }

    /**
     * Creates a new Medicamentos entity.
     *
     * @Route("/", name="medicamentos_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:Medicamentos:new.html.twig")
     */
    public function createAction(Request $request) {
        
        $entity = new Medicamentos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        $principio = $entity->getPrincipioActivo();

        $principio_minuscula = strtolower($principio);

        $descripcion = ucwords($principio_minuscula);

        $entity->setPrincipioActivo($descripcion);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->forward("EnfermeriaBundle:Auditoria:registrar", array('accion' => "insertar", 'entidad' => "medicamentos", 'entidadId' => $entity->getId()));

            return $this->redirect($this->generateUrl('medicamentos_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Medicamentos entity.
     *
     * @param Medicamentos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Medicamentos $entity) {
        
        $form = $this->createForm(new MedicamentosType(), $entity, array(
            'action' => $this->generateUrl('medicamentos_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Medicamentos entity.
     *
     * @Route("/new", name="medicamentos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
      
        $entity = new Medicamentos();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Medicamentos entity.
     *
     * @Route("/{id}", name="medicamentos_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
       
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Medicamentos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medicamentos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Medicamentos entity.
     *
     * @Route("/{id}/edit", name="medicamentos_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Medicamentos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medicamentos entity.');
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
     * Creates a form to edit a Medicamentos entity.
     *
     * @param Medicamentos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Medicamentos $entity) {
       
        $form = $this->createForm(new MedicamentosType(), $entity, array(
            'action' => $this->generateUrl('medicamentos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }

    /**
     * Edits an existing Medicamentos entity.
     *
     * @Route("/{id}", name="medicamentos_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:Medicamentos:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Medicamentos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medicamentos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        $principio = $entity->getPrincipioActivo();

        $principio_minuscula = strtolower($principio);

        $descripcion = ucwords($principio_minuscula);

        $entity->setPrincipioActivo($descripcion);


        if ($editForm->isValid()) {
            $em->flush();
            $this->forward("EnfermeriaBundle:Auditoria:registrar", array('accion' => "modificar", 'entidad' => "medicamentos", 'entidadId' => $entity->getId()));

            return $this->redirect($this->generateUrl('medicamentos'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Medicamentos entity.
     *
     * @Route("/{id}", name="medicamentos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
       
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:Medicamentos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Medicamentos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('medicamentos'));
    }

    /**
     * Creates a form to delete a Medicamentos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
       
        return
                        $this->createFormBuilder()
                        ->setAction($this->generateUrl('medicamentos_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}