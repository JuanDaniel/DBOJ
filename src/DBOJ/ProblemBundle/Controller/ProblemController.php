<?php

namespace DBOJ\ProblemBundle\Controller;

use DBOJ\ProblemBundle\Entity\Problem;
use DBOJ\ProblemBundle\Form\ProblemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
                $entity->getCreationDate()->format('Y-m-d'),
                $entity->getState()->getValue(),
                $entity->getNameDatabase(),
                $entity->getTime(),
                $entity->getMemory(),
                $this->renderView('CommonBundle:Extras:option_list.html.twig', array(
                    'path_edit' => 'problem_edit',
                    'path_delete' => 'problem_delete',
                    'title_edit' => 'Editar problema',
                    'title_delete' => 'Eliminar problema',
                    'msg_confirm' => '¿Desea eliminar el problema?'
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
        
        $entity->setCreationDate(new \DateTime('now'));
        $entity->setNameDatabase(uniqid('dboj_'));
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Problema registrado satisfactoriamente'
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
            throw $this->createNotFoundException('El problema especificado no existe');
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
            throw $this->createNotFoundException('El problema especificado no existe');
        }
        
        $editForm = $this->createForm(new ProblemType(), $entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Problema modificado satisfactoriamente'
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
            throw $this->createNotFoundException('El problema especificado no existe');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', 'Problema eliminado satisfactoriamente'
        );

        return $this->redirect($this->generateUrl('problem'));
    }
}
