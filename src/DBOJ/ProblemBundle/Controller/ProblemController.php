<?php

namespace DBOJ\ProblemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProblemController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProblemBundle:Problem:index.html.twig', array('name' => $name));
    }
}
