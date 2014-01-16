<?php

namespace DBOJ\ProblemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DBOJ\ProblemBundle\Form\ProblemType;

class ProblemController extends Controller
{
    /**
     * Lists all Problems entities.
     *
     */
    public function indexAction()
    {   
        return $this->render('ProblemBundle:Problem:index.html.twig');
    }
    
    public function listAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        
        $total = $em->getRepository('ProblemBundle:Problem')->getTotal();
        $entities = $em->getRepository('ProblemBundle:Problem')->getEntities($request);
        
        $data = array(
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => count($entities),
            'aaData' => array()
        );
        
        foreach($entities as $entity){      
            $data['aaData'][] = array(
                $entity->getTitle(),
                $entity->getCreationDate(),
                $entity->getActive(),
                $entity->getNameDatabase(),
                $entity->getTime(),
                $entity->getMemory(),
                $entity->getCompetition()->getName(),
                $this->renderView('BackendBundle:Extras:option_list.html.twig', array(
                    'path_edit' => 'problem_edit',
                    'path_delete' => 'problem_delete',
                    'title_edit' => 'Edit data of problem',
                    'title_delete' => 'Remove problem',
                    'msg_confirm' => 'Do you really want to eliminate problem?'
                    . '',
                    'entity' => $entity
                ))
            );
        }
        
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    
    /**
     * Creates a new Problem entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Problem();
        $form = $this->createForm(new ProblemType(), $entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Problem successfully added'
            );

            return $this->redirect($this->generateUrl('problem'));
        }

        return $this->render('ProblemBundle:Problem:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Problem entity.
     *
     */
    public function newAction()
    {
        $entity = new Problem();
        $form   = $this->createForm(new ProblemType(), $entity);

        return $this->render('ProblemBundle:Problem:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Problem entity.
     *
     */
    public function editAction($id)
    {        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProblemBundle:Problem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('The problem specified does not exististe');
        }

        $editForm = $this->createForm(new ProblemType(), $entity);

        return $this->render('ProblemBundle:Problem:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Problem entity.
     *
     */
    public function updateAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProblemBundle:Problem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('The problem specified does not exist');
        }
        
        $editForm = $this->createForm(new ProblemType(), $entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Problem successfully modified'
            );
            
            return $this->redirect($this->generateUrl('problem'));
        }

        return $this->render('ProblemBundle:Problem:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    /**
     * Deletes a Problem entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('ProblemBundle:Problem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('The problem specified does not exist');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', 'Problem successfully removed'
        );

        return $this->redirect($this->generateUrl('problem'));
    }
}
