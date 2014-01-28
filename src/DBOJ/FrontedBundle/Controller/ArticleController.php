<?php

namespace DBOJ\FrontedBundle\Controller;

use DBOJ\NewsBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller {

    public function allAction() {
        $em = $this->getDoctrine()->getManager();

        $paginator = $this->get('ideup.simple_paginator');
        $paginator->setItemsPerPage(20);

        $entities = $paginator->paginate($em->getRepository('NewsBundle:Article')->findBy(array(
                            'publish' => true
                                ), array('publicationDate' => 'DESC')
                ))->getResult();

        return $this->render('FrontendBundle:Default:home.html.twig', array(
            'entities' => $entities,
            'paginator' => $paginator
        ));
    }

    public function showAction($slug) {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NewsBundle:Article')->findOneBy(array('slug' => $slug));
        
        if(!$entity)
            return $this->createNotFoundException('No existe el artículo especificado');
        
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
