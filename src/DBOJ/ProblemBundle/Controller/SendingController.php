<?php

namespace DBOJ\ProblemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DBOJ\ProblemBundle\Form\SendingType;
use DBOJ\ProblemBundle\Entity\Sending;

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
                $entity->getAnswer(),
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
    
    public function createAction(Request $request)
    {
        $entity = new Sending();
        $form = $this->createForm(new SendingType(), $entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice', 'Sending successfully added'
            );

            return $this->redirect($this->generateUrl('sending'));
        }

        return $this->render('ProblemBundle:Sending:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    public function newAction()
    {
        $entity = new Sending();
        $form   = $this->createForm(new SendingType(), $entity);

        return $this->render('ProblemBundle:Sending:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    public function editAction($id)
    {        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ProblemBundle:Sending')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('The sending specified does not exist');
        }

        $editForm = $this->createForm(new SendingType(), $entity);

        return $this->render('ProblemBundle:Sending:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
    public function updateAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProblemBundle:Sending')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('The sending specified does not exist');
        }
        
        $editForm = $this->createForm(new SendingType(), $entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Sending successfully modified'
            );
            
            return $this->redirect($this->generateUrl('sending'));
        }

        return $this->render('ProblemBundle:Sending:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
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
