<?php

namespace DBOJ\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Administración");
        
        return $this->render('BackendBundle:Dashboard:index.html.twig');
    }
    
    public function getStatsAction(){
        $em = $this->getDoctrine()->getManager();
        
        $stats = array(
            'count' => array(
                'users' =>  $em->getRepository('UserBundle:User')->getTotal(),
                'comments' => $em->getRepository('NewsBundle:Comment')->getTotal(),
                'prolems' => $em->getRepository('ProblemBundle:Problem')->getTotal(),
            )
        );
    }
}
