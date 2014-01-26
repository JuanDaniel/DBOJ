<?php

namespace DBOJ\FrontedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontendBundle:Competition:ranking.html.twig');
    }
}
