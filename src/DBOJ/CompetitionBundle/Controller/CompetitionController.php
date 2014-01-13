<?php

namespace DBOJ\CompetitionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompetitionController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CompetitionBundle:Competition:index.html.twig', array('name' => $name));
    }
}
