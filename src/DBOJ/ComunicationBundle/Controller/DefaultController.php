<?php

namespace DBOJ\ComunicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $connection = $this->get('comunication.xmpp');

        $connection->send();

        return $this->render('ComunicationBundle:Default:index.html.twig', array(
            'jid'=>'admin@rsn.local',
            'password'=>'overmind'
        ));
    }
}
