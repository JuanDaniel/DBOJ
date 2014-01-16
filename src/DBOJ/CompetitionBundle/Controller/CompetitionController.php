<?php

namespace DBOJ\CompetitionBundle\Controller;

use DBOJ\CompetitionBundle\Entity\Competition;
use DBOJ\CompetitionBundle\Form\CompetitionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CompetitionController extends Controller {

    public function indexAction() {
        return $this->render('CompetitionBundle:Competition:index.html.twig');
    }

    public function listAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $total = $em->getRepository('CompetitionBundle:Competition')->getTotal();
        $entities = $em->getRepository('CompetitionBundle:Competition')->getEntities($request);

        $data = array(
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => count($entities),
            'aaData' => array()
        );

        foreach ($entities as $entity) {
            $data['aaData'][] = array(
                $entity->getName(),
                $entity->getCreationDate(),
                $entity->getStartDate(),
                $entity->getDuration(),
                $entity->getActive(),
                $entity->getType(),
                $this->renderView('CommonBundle:Extras:option_list.html.twig', array(
                    'path_edit' => 'competition_edit',
                    'path_delete' => 'competition_delete',
                    'title_edit' => 'Edit data of competition',
                    'title_delete' => 'Remove competition',
                    'msg_confirm' => 'Do you really want to eliminate competition?',
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
        $entity = new Competition();
        $form = $this->createForm(new CompetitionType(), $entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice', 'Competition successfully added'
            );

            return $this->redirect($this->generateUrl('competition'));
        }

        return $this->render('CompetitionBundle:Competition:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    public function newAction()
    {
        $entity = new Competition();
        $form   = $this->createForm(new CompetitionType(), $entity);

        return $this->render('CompetitionBundle:Competition:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    public function editAction($id)
    {        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CompetitionBundle:Competition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('The competition specified does not exist');
        }

        $editForm = $this->createForm(new CompetitionType(), $entity);

        return $this->render('CompetitionBundle:Competition:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
    public function updateAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CompetitionBundle:Competition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('The competition specified does not exist');
        }
        
        $editForm = $this->createForm(new CompetitionType(), $entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Competition successfully modified'
            );
            
            return $this->redirect($this->generateUrl('competition'));
        }

        return $this->render('CompetitionBundle:Competition:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('CompetitionBundle:Competition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('The competition specified does not exist');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', 'Competition successfully removed'
        );

        return $this->redirect($this->generateUrl('competition'));
    }
}
