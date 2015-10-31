<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Usuarios;
use CDI\EnfermeriaBundle\Form\UsuariosType;

/**
 * Usuarios controller.
 *
 * @Route("/usuarios")
 */
class UsuariosController extends Controller
{

    /**
     * Lists all Usuarios entities.
     *
     * @Route("/", name="usuarios")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfermeriaBundle:Usuarios')->findAll();

        return array(
            'entities' => $entities,
        );
    }

}
