<?php

namespace DBOJ\BackendBundle\Controller;

use DBOJ\BackendBundle\Form\ComunicationParametersType;
use DBOJ\BackendBundle\Form\EngineParametersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ParametersController
 *
 * @author jdsantana
 */
class ParametersController extends Controller {
    
    public function indexAction(){
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Administración", $this->generateUrl('dashboard'));
        $breadcrumbs->addItem("Parámetros");
        
        $data_engine = array(
            'host_db' => $this->container->getParameter('backend.engine.host_db'),
            'port_db' => $this->container->getParameter('backend.engine.port_db'),
            'user_db' => $this->container->getParameter('backend.engine.user_db'),
            'password_db' => $this->container->getParameter('backend.engine.password_db'),
            'user_xmpp' => $this->container->getParameter('backend.engine.user_xmpp'),
            'password_xmpp' => $this->container->getParameter('backend.engine.password_xmpp'),
        );
        $form_engine = $this->createForm(new EngineParametersType(), $data_engine);
        
        $data_comunication = array(
            'host_xmpp' => $this->container->getParameter('backend.comunication.host_xmpp'),
            'port_xmpp' => $this->container->getParameter('backend.comunication.port_xmpp'),
            'user_xmpp' => $this->container->getParameter('backend.comunication.user_xmpp'),
            'password_xmpp' => $this->container->getParameter('backend.comunication.password_xmpp'),
        );
        $form_comunication = $this->createForm(new ComunicationParametersType(), $data_comunication);
        
        return $this->render('BackendBundle:Parameters:index.html.twig', array(
            'form_engine' => $form_engine->createView(),
            'form_comunication' => $form_comunication->createView()
        ));
    }
    
    public function engineAction(Request $request){
        $form = $this->createForm(new EngineParametersType());
        $form->handleRequest($request);
        $parameters = $form->getData();
        
        
        
        return $this->redirect($this->generateUrl('parameters'));
    }
}
