<?php

namespace DBOJ\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use DBOJ\UserBundle\Form\Frontend\UserType;

class DefaultController extends Controller {

    public function indexAction() {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Inicio");

        return $this->forward('FrontendBundle:Article:all');
    }

    public function loginAction(Request $request) {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Inicio", $this->generateUrl('frontendBundle_home'));
        $breadcrumbs->addItem("Acceder");

        $session = $request->getSession();

        $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR, $session->get(SecurityContext::AUTHENTICATION_ERROR)
        );

        $form = $this->createForm(new UserType());

        return $this->render('FrontendBundle:Default:login.html.twig', array(
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error' => $error,
                    'form' => $form->createView()
                        )
        );
    }

}
