<?php

namespace DBOJ\FrontedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Inicio");
//        
        return $this->forward('FrontendBundle:Article:all');
    }

}
