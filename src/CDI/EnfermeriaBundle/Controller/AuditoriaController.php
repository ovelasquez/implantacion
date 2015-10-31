<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Auditoria;

/**
 * Auditoria controller.
 *
 * @Route("/auditoria")
 */
class AuditoriaController extends Controller {

    /**
     * Lists all Auditoria entities.
     *
     * @Route("/", name="auditoria")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('EnfermeriaBundle:Auditoria')->findAll();


        return array(
            'entities' => $entities,
        );
    }

    private function get_cliente_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }

    public function registrarAction($accion, $entidad, $entidadId) {
        $em = $this->getDoctrine()->getManager();
        $auditoria = new Auditoria();

        $auditoria->setAccion($accion);
        $auditoria->setEntidad($entidad);
        $auditoria->setEntidadId($entidadId);
        $auditoria->setFechaHora(new \DateTime("now"));
        $auditoria->setIp($this->get_cliente_ip());
        $auditoria->setQuery("");
        $auditoria->setUsuario($this->get('security.context')->getToken()->getUser());

        $em->persist($auditoria);
        $em->flush();
    }

    /**
     * Finds and displays a Auditoria entity.
     *
     * @Route("/{id}", name="auditoria_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Auditoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auditoria entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

}
