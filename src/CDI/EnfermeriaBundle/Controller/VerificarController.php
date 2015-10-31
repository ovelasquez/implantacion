<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Consultas;

/**
 * Consultas controller.
 *
 * @Route("/verificar")
 */
class VerificarController extends Controller {

    /**
     * Verificar si el paciente existe
     * @Route("/verificar", name="verificar")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        return $this->render('EnfermeriaBundle:Verificar:index.html.twig');
    }

    /**
     * @Route("/verificarone", name="verificarone")
     * @Method("POST")    
     */
    public function createAction(Request $request) {

        $reqe = $request->request->all();
        $cedula = $reqe["cedula"];

        // Verificamos si la persona esta registrada      
        $em = $this->getDoctrine()->getManager();
        $estaRegistrado = $em->getRepository('EnfermeriaBundle:Datos')->findByCedula($cedula);
        //var_dump($estaRegistrado);  die;
        //Si no esta registrado lo creamos como un Paciente                                
        if (count($estaRegistrado) == 0) {
            return $this->render('EnfermeriaBundle:Verificar:confirmar.html.twig', array('cedula' => $cedula));
        } else {
            // Si esta registrados entonces Verificamos si es un Paciente                    
            $esPaciente = "
                    SELECT p
                    FROM EnfermeriaBundle:Pacientes p
                    WHERE p.datos = " . $estaRegistrado[0]->getId();

            $query = $em->createQuery($esPaciente);
            $esPaciente = $query->getResult();

            //echo ("<pre>"); var_dump($esPaciente); echo("</pre>"); die;
            //echo ("<pre>"); debug_zval_dump($estaRegistrado[0]->getId()); echo("</pre>"); die;
            //
            // Si no es un Paciente lo registramos como paciente y le pasamos el ID de sus Datos
            if (!$esPaciente) {
                $id = $estaRegistrado[0]->getId();

                return $this->redirect($this->generateUrl('pacientes_new', array('id' => $id)));
            }


            // Si es Paciente y tiene una consulta activa 
            //$tieneConsulta = new Consultas();
            $tieneConsulta = "
                    SELECT c
                    FROM EnfermeriaBundle:Consultas c
                    WHERE c.egreso=false and c.paciente = " . $esPaciente[0]->getId();
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($tieneConsulta);
            $tieneConsulta = $query->getResult();


            /*
             * ¿Cuando generamos una nueva consulta?:   Si no tiene consulta
             * ¿Cuando generamos un editar consulta?    Si tiene consulta y egreso=true
             */

            if (!$tieneConsulta) {

                //Objeto del Usuario que suministro
                $em = $this->getDoctrine()->getManager();
                $entityUsuario = $em->getRepository('EnfermeriaBundle:Usuarios')->find($this->get('security.context')->getToken()->getUser());
                $entityPaciente = $em->getRepository('EnfermeriaBundle:Pacientes')->find($esPaciente[0]->getId());

                $consulta = new Consultas();
                $consulta->setCharla(false);
                $consulta->setEgreso(false);
                $consulta->setFecha(new \DateTime("now"));
                $consulta->setPaciente($entityPaciente);
                $consulta->setUsuarios($entityUsuario);
                $consulta->setReferencia('intrahospitalaria');
                $em->persist($consulta);
                $em->flush();
                return $this->redirect($this->generateUrl('consultas_edit', array('id' => $consulta->getId())));
            } else {
                return $this->redirect($this->generateUrl('consultas_edit', array('id' => $tieneConsulta[0]->getId())));
            }
        }
    }

}
