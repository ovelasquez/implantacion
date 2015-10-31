<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Consultas controller.
 *
 * @Route("/ajax")
 */
class AjaxController extends Controller {

    /**     
     * @Route("/", name="ajaxmedicamentos")
     * @Method("POST")
     * @Template()
     */
    public function medicamentosAction(Request $request) {
        $id = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('EnfermeriaBundle:Medicamentos')->find($id);
        $salida = $entities->getDisponible();       
        return array(
            'entities' => $salida,
        );
    }
    
    
    
    /**     
     * @Route("/insumos", name="ajaxinsumos")
     * @Method("POST")
     * @Template()
     */
    public function insumosAction(Request $request) {
        $id = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('EnfermeriaBundle:Insumos')->find($id);
        $salida = $entities->getDisponible();       
        return array(
            'entities' => $salida,
        );
    }

}
