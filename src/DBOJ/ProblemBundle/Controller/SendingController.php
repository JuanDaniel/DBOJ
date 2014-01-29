<?php

namespace DBOJ\ProblemBundle\Controller;

use DateTime;
use DBOJ\CommonBundle\Entity\Catalog;
use DBOJ\CommonBundle\Entity\Nomenclator;
use DBOJ\ProblemBundle\Entity\Sending;
use DBOJ\ProblemBundle\Form\SendingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SendingController extends Controller {

    public function indexAction() {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Administración", $this->generateUrl('dashboard'));
        $breadcrumbs->addItem("Envío");
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
                $entity->getSendingDate()->format('Y-m-d'),
                $entity->getQualification()->getValue(),
                $entity->getTime(),
                $entity->getMemory(),
                $entity->getUser()->getName(),
                $entity->getProblem()->getTitle(),
                $this->renderView('CommonBundle:Extras:option_list.html.twig', array(
                    'entity' => $entity
                ))
            );
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    
    public function createAction(Request $request, $id) {
        $entity = new Sending();
        $form = $this->createForm(new SendingType(), $entity);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
                        
        $nomenclador = $em->getRepository('CommonBundle:Nomenclator')->findOneBy(array(
            'value'=>'femenino'
        ));
               
        $entity->setSendingDate(new DateTime('now'));
        $entity->setTime(0);
        $entity->setMemory(0);
        $entity->setUser($this->get('security.context')->getToken()->getUser());
        $entity->setProblem($em->getRepository('ProblemBundle:Problem')->find($id));
        $entity->setQualification($nomenclador);
        
                
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice', 'Envío satisfactorio'
            );

            return $this->redirect($this->generateUrl('frontend_problem_index'));
        }

        return $this->render('ProblemBundle:Frontend:show.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }
    
    public function deleteAction($id) {
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
