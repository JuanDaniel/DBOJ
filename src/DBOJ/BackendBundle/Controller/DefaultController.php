<?php

namespace DBOJ\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        
        $error = $request->attributes->get(
            SecurityContext::AUTHENTICATION_ERROR, $session->get(SecurityContext::AUTHENTICATION_ERROR)
        );
        
        return $this->render('BackendBundle:Default:login.html.twig', array(
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error' => $error
            )
        );
    }
    
    public function getNotificationsAction(){
        $em = $this->getDoctrine()->getManager();
        
        $comments = $em->getRepository('NewsBundle:Comment')->findBy(array(
            'publish' => true
        ),
        array('date' => 'DESC'));
        
        return $this->render('BackendBundle:Extras:notifications.html.twig', array(
            'comments' => $comments
        ));
    }
}
