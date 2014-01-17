<?php

namespace DBOJ\ProblemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SendingController extends Controller
{
    public function indexAction() {
        return $this->render('ProblemBundle:Sending:index.html.twig');
    }

    public function listAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $total = $em->getRepository('ProblemBundle:Sending')->getTotal();
        $entities = $em->getRepository('ProblemBundle:Sending')->getEntities($request);

        $data = array(
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => count($entities),
            'aaData' => array()
        );

        foreach ($entities as $entity) {
            $data['aaData'][] = array(
                $entity->getSendingDate(),
                $entity->getTime(),
                $entity->getMemory(),
                $entity->getUser()->getName(),
                $entity->getProblem()->getTitle(),
                $this->renderView('CentralBundle:Extras:option_list.html.twig', array(
                    'entity' => $entity
                ))
            );
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }    
    
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('ProblemBundle:Sending')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('The sending specified does not exist');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', 'Sending successfully removed'
        );

        return $this->redirect($this->generateUrl('sending'));
    }
}
