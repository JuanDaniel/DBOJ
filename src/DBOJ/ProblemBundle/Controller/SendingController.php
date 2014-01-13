<?php

namespace DBOJ\ProblemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SendingController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProblemBundle:Sending:index.html.twig', array('name' => $name));
    }
}
