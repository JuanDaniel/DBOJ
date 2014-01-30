<?php

namespace DBOJ\ComunicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ComunicationBundle:Default:index.html.twig', array('name' => $name));
    }
}
