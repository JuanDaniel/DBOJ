<?php

namespace DBOJ\CompetitionBundle\Controller;

use DBOJ\CompetitionBundle\Entity\Team;
use DBOJ\CompetitionBundle\Form\TeamType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller {

    public function indexAction() {
        return $this->render('CompetitionBundle:Team:index.html.twig');
    }

    public function listAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $total = $em->getRepository('CompetitionBundle:Team')->getTotal();
        $entities = $em->getRepository('CompetitionBundle:Team')->getEntities($request);

        $data = array(
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => count($entities),
            'aaData' => array()
        );

        foreach ($entities as $entity) {
            $data['aaData'][] = array(
                $entity->getName(),
                $entity->getCreationDate()->format('Y-m-d'),
                $this->renderView('CommonBundle:Extras:option_list.html.twig', array(
                    'path_edit' => 'team_edit',
                    'path_delete' => 'team_delete',
                    'title_edit' => 'Editar equipo',
                    'title_delete' => 'Eliminar equipo',
                    'msg_confirm' => '¿Desea eliminar este equipo?',
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
        $entity = new Team();
        $form = $this->createForm(new TeamType(), $entity);
        $form->handleRequest($request);
        
        $entity->setCreationDate(new \DateTime('now'));
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice', 'Equipo registrado satisfactoriamente'
            );

            return $this->redirect($this->generateUrl('team'));
        }

        return $this->render('CompetitionBundle:Team:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    public function newAction()
    {
        $entity = new Team();
        $form   = $this->createForm(new TeamType(), $entity);

        return $this->render('CompetitionBundle:Team:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    public function editAction($id)
    {        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CompetitionBundle:Team')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El equipo especificado no existe');
        }

        $editForm = $this->createForm(new TeamType(), $entity);

        return $this->render('CompetitionBundle:Team:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
    public function updateAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CompetitionBundle:Team')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El equipo especificado no existe');
        }
        
        $editForm = $this->createForm(new TeamType(), $entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Equipo modificado satisfactoriamente'
            );
            
            return $this->redirect($this->generateUrl('team'));
        }

        return $this->render('CompetitionBundle:Team:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('CompetitionBundle:Team')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El equipo especificado no existe');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', 'Equipo eliminado satisfactoriamente'
        );

        return $this->redirect($this->generateUrl('team'));
    }
}
