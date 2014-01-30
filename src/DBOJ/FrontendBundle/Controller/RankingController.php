<?php

namespace DBOJ\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RankingController extends Controller {

    public function indexAction() {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Inicio", $this->generateUrl('frontendBundle_home'));
        $breadcrumbs->addItem("Posiciones");
        return $this->render('ProblemBundle:Frontend:ranking.html.twig');
    }

    public function listAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $total = $em->getRepository('UserBundle:User')->getTotal();
        $entities = $em->getRepository('UserBundle:User')->getEntities($request);

        $data = array(
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => count($entities),
            'aaData' => array()
        );

        foreach ($entities as $entity) {
            $aceptados = $em->getRepository('ProblemBundle:Sending')->getAcceptedByUser($entity);
            $envios = $em->getRepository('ProblemBundle:Sending')->getTotalSending($entity);

            $data['aaData'][] = array(
                '1',
                $entity->getUser(),
                $envios,
                $aceptados,
                ($aceptados/$envios)*100,
                '1000'
            );           
        }
        
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
