<?php

namespace DBOJ\FrontedBundle\Controller;

use DBOJ\NewsBundle\Form\CommentType;
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
        
        $form = $this->createForm(new CommentType());
        
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Inicio", $this->generateUrl('frontendBundle_home'));
        $breadcrumbs->addItem($entity->getTitle());

        return $this->render('NewsBundle:Frontend:show.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
        ));
    }
}
