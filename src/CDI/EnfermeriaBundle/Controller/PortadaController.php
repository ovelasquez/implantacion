<?php
namespace CDI\EnfermeriaBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * Portada controller.
 *
 * @Route("/portada")
 */
class PortadaController extends Controller {

    /**
     * Lists all Portada entities.
     *
     * @Route("/", name="portada")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        
        return $this->render('EnfermeriaBundle:Portada:index.html.twig');
    }
}