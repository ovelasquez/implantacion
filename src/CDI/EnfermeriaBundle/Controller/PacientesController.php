<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Pacientes;
use CDI\EnfermeriaBundle\Form\PacientesType;

/**
 * Pacientes controller.
 *
 * @Route("/pacientes")
 */
class PacientesController extends Controller {

    /**
     * Lists all Pacientes entities.
     *
     * @Route("/list", name="pacientes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {               
        $em = $this->getDoctrine()->getManager();
        $mi_query = $em->getRepository('EnfermeriaBundle:Pacientes')->findBy(array(), array('fechaRegistro' => 'DESC'));
        // Añadimos el paginador KNPBundle(En este caso el parámetro "1" es la página actual, y parámetro "10" es el número de páginas a mostrar)
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($mi_query, $this->get('request')->query->get('page', 1), 5);
        // Añadimos el parámetro a la plantilla       
        return $this->render('EnfermeriaBundle:Pacientes:index.html.twig', array('pagination' => $pagination)
        );
    }

    /**
     * Creates a new Pacientes entity.
     *
     * @Route("/", name="pacientes_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:Pacientes:new.html.twig")
     */
    public function createAction(Request $request) {
        $var = $request->request->get('cdi_enfermeriabundle_pacientes');
        $cedula = $var['datos']['cedula'];


        $entity = new Pacientes();
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
            
            $entity->setFechaRegistro(new \DateTime("now"));
            $em = $this->getDoctrine()->getManager();

            //Verificar que si el paciente esta registrado en Datos            
            
            $entity_datos = $em->getRepository('EnfermeriaBundle:Datos')->findByCedula($cedula);
            //si el paciente esta en datos entonces uso esos datos si no el los crea
            if (count($entity_datos) == 1) {
                $entity->setDatos($entity_datos[0]);
            }
            $em->persist($entity);
            $em->flush();
             // Registramos la accion en la auditoria
            //$this->forward("EnfermeriaBundle:Auditoria:registrar", array('accion' => "insertar", 'entidad' => "pacientes", 'entidadId' => $entity->getId()));

            return $this->redirect($this->generateUrl('pacientes_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Pacientes entity.
     *
     * @param Pacientes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pacientes $entity) {
        
        $form = $this->createForm(new PacientesType(), $entity, array(
            'action' => $this->generateUrl('pacientes_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Pacientes entity.
     *
     * @Route("/new/{id}", name="pacientes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = Null) {
        $entity = new Pacientes();
        
        $em = $this->getDoctrine()->getManager();

        if ($id != Null) {
            //Verificamos que este registrado en Datos
            $entity_datos = $em->getRepository('EnfermeriaBundle:Datos')->find($id);
            if (!$entity_datos) {
                throw $this->createNotFoundException('Datos del paciente no existe.');
            } else {
                $entity->setDatos($entity_datos);
            }
        }
        
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            
        );
    }

    /**
     * Displays a form to create a new Pacientes entity.
     *
     * @Route("/crear/{cedula}", name="pacientes_crear")
     * @Method("GET")
     * @Template()
     */
    public function crearAction($cedula = Null) {       
        $entity = new Pacientes();

        $form = $this->createCreateForm($entity);

        return $this->render('EnfermeriaBundle:Pacientes:new.html.twig', array('entity' => $entity, 'form' => $form->createView(), 'cedula' => $cedula));
    }

    /**
     * Finds and displays a Pacientes entity.
     *
     * @Route("/{id}", name="pacientes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Pacientes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pacientes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Pacientes entity.
     *
     * @Route("/edit/{id}", name="pacientes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {

        $em = $this->getDoctrine()->getManager();
        $entity = new Pacientes();
        $entity = $em->getRepository('EnfermeriaBundle:Pacientes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pacientes entity.');
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
     * Creates a form to edit a Pacientes entity.
     *
     * @param Pacientes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Pacientes $entity) {

        $form = $this->createForm(new PacientesType(), $entity, array(
            'action' => $this->generateUrl('pacientes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }

    /**
     * Edits an existing Pacientes entity.
     *
     * @Route("/{id}", name="pacientes_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:Pacientes:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Pacientes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pacientes entity.');
        }


        $deleteForm = $this->createDeleteForm($id);

        $date = $entity->getFechaNacimiento();
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
            $this->forward("EnfermeriaBundle:Auditoria:registrar", array('accion' => "modificar", 'entidad' => "pacientes", 'entidadId' => $entity->getId()));

           // return $this->redirect($this->generateUrl('pacientes'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Pacientes entity.
     *
     * @Route("/{id}", name="pacientes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {

        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:Pacientes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pacientes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pacientes'));
    }

    /**
     * Creates a form to delete a Pacientes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
       
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('pacientes_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit','submit',array('label'=>'Eliminar','attr'=>array('class'=>'btn btn-danger')))
                        ->getForm()
        ;
    }
}