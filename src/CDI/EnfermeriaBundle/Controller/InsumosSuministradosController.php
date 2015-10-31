<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\InsumosSuministrados;
use CDI\EnfermeriaBundle\Form\InsumosSuministradosType;

/**
 * InsumosSuministrados controller.
 *
 * @Route("/insumossuministrados")
 */
class InsumosSuministradosController extends Controller {

    /**
     * Lists all InsumosSuministrados entities.
     *
     * @Route("/", name="insumossuministrados")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
       
        // Aquí por tu query
        $em = $this->getDoctrine()->getManager();

        $mi_query = $em->getRepository('EnfermeriaBundle:InsumosSuministrados')->findAll();
        // Añadimos el paginador KNPBundle(En este caso el parámetro "1" es la página actual, y parámetro "10" es el número de páginas a mostrar)
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $mi_query, $this->get('request')->query->get('page', 1), 5);

        // Añadimos el parámetro a la plantilla
        return $this->render('EnfermeriaBundle:InsumosSuministrados:index.html.twig', array('pagination' => $pagination)
        );
    }

    /**
     * Creates a new InsumosSuministrados entity.
     *
     * @Route("/", name="insumossuministrados_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:InsumosSuministrados:new.html.twig")
     */
    public function createAction(Request $request) {
       
        $entity = new InsumosSuministrados();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->get('security.context')->getToken()->getUser();
            $entity->setUsuario($user);
            $entity->setFecha(new \DateTime("now"));
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('insumossuministrados_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a InsumosSuministrados entity.
     *
     * @param InsumosSuministrados $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(InsumosSuministrados $entity) {
       
        $form = $this->createForm(new InsumosSuministradosType(), $entity, array(
            'action' => $this->generateUrl('insumossuministrados_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }

    /**
     * Displays a form to create a new InsumosSuministrados entity.
     *
     * @Route("/new", name="insumossuministrados_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
       
        $entity = new InsumosSuministrados();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a InsumosSuministrados entity.
     *
     * @Route("/{id}", name="insumossuministrados_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:InsumosSuministrados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InsumosSuministrados entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing InsumosSuministrados entity.
     *
     * @Route("/{id}/edit", name="insumossuministrados_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:InsumosSuministrados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InsumosSuministrados entity.');
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
     * Creates a form to edit a InsumosSuministrados entity.
     *
     * @param InsumosSuministrados $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(InsumosSuministrados $entity) {
       
        $form = $this->createForm(new InsumosSuministradosType(), $entity, array(
            'action' => $this->generateUrl('insumossuministrados_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }

    /**
     * Edits an existing InsumosSuministrados entity.
     *
     * @Route("/{id}", name="insumossuministrados_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:InsumosSuministrados:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
       
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:InsumosSuministrados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InsumosSuministrados entity.');
        }
        
         //Valor de la cantidad de Insumo suministrada anteriormente en la consulta
        $cantidad = ($entity->getCantidad());

        //Busqueda Del Objeto Insumos para restarle o sumarle la cantidad suministrada a la cantidad Disponible en el inventario
        $insumo = $em->getRepository('EnfermeriaBundle:Insumos')->find($entity->getInsumo());


        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $user = $this->get('security.context')->getToken()->getUser();
            $entity->setUsuario($user);
            
            $cantidadActual = $entity->getCantidad();
            
             //Si la cantidad Suministrada anteriormente es mayor que la cantidad actualizada, restarlas y actualizar la cantidad Disponible en el Inventario
            if ($cantidad > $cantidadActual) {
                $insumo->setDisponible($insumo->getDisponible() + ($cantidad - $cantidadActual));
            }
            //Si la cantidad Suministrada anteriormente es menor que la cantidad actualizada, Sumarlas y actualizar la cantidad Disponible en el Inventario
            elseif ($cantidad < $cantidadActual) {
                $insumo->setDisponible($insumo->getDisponible() - ($cantidadActual - $cantidad));
            }
            
            $em->flush();
            // Registramos la accion en la auditoria
            $this->forward("EnfermeriaBundle:Auditoria:registrar", array('accion' => "modificar", 'entidad' => "insumossuministrados", 'entidadId' => $entity->getId()));

            return $this->redirect($this->generateUrl('insumossuministrados'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a InsumosSuministrados entity.
     *
     * @Route("/{id}", name="insumossuministrados_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
       
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:InsumosSuministrados')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InsumosSuministrados entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('insumossuministrados'));
    }

    /**
     * Creates a form to delete a InsumosSuministrados entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('insumossuministrados_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Eliminar', 'attr' => array('class' => 'btn')))
                        ->getForm()
        ;
    }

}