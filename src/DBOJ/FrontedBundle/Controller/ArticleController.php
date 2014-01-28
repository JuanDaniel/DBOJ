<?php

namespace DBOJ\FrontedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller {

    public function allAction() {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NewsBundle:Article')->findAll();

        return $this->render('FrontendBundle:Default:home.html.twig', array(
                    'entity' => $entity
        ));
    }

    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NewsBundle:Article')->find($id);

        return $this->render('FrontendBundle:Article:show.html.twig', array(
                    'entity' => $entity
        ));
    }

    public function indexAction() {
        return $this->render('FrontendBundle:Competition:index_sending.html.twig');
    }

}
