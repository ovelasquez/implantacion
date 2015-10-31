<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction() {
        // Registramos la accion en la auditoria
        
//        $this->forward("EnfermeriaBundle:Consultas:activas", array());
        return $this->render('EnfermeriaBundle:Verificar:index.html.twig');
    }

}
