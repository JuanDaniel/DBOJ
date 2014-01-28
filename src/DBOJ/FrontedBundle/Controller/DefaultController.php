<?php

namespace DBOJ\FrontedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('NewsBundle:Article')->findAll();
//
//        return $this->render('FrontendBundle:Default:home.html.twig', array(
//                    'entity' => $entity
//        ));
        
        return $this->forward('FrontendBundle:Article:all');
    }

}
