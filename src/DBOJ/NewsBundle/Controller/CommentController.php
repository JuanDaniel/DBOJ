<?php

namespace DBOJ\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of CommentController
 *
 * @author JuanLuis
 */
class CommentController extends Controller {
    /**
     * Lists all Comment entities.
     *
     */
    public function indexAction() {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Administración", $this->generateUrl('dashboard'));
        $breadcrumbs->addItem("Comentarios");  
        return $this->render('NewsBundle:Comment:index.html.twig');
    }

    public function listAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $total = $em->getRepository('NewsBundle:Comment')->getTotal();
        $entities = $em->getRepository('NewsBundle:Comment')->getEntities($request);

        $data = array(
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => count($entities),
            'aaData' => array()
        );
        
        foreach ($entities as $entity) {
            $data['aaData'][] = array(               
                $entity->getArticle()->getTitle(),
                $entity->getUser()->getUser(),  
                $entity->getState()->getValue(),
                $this->renderView('CommonBundle:Extras:option_list.html.twig', array(
                    'path_publish' => 'comment_publish',
                    'path_edit' => 'comment_edit',
                    'path_delete' => 'comment_delete',
                    'title_publish' => 'Cambiar estado del comentario',
                    'title_edit' => 'Editar los datos del comentario',
                    'title_delete' => 'Eliminar el comentario',
                    'msg_confirm' => '¿Desea realmente eliminar el comentario?',
                    'state' => $entity->getPublish(),
                    'entity' => $entity
                ))
            );
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a new Comment entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Comment();
        $form = $this->createForm(new CommentType(), $entity);
        $form->handleRequest($request);
        
        $entity->setDate(new \DateTime('now'));
        $entity->setUser($this->get('security.context')->getToken()->getUser());
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'El comentario se ha agregado exitosamente'
            );

            return $this->redirect($this->generateUrl('comment'));
        }

        return $this->render('NewsBundle:Comment:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Comment entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NewsBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El comentario especificado no existe');
        }

        $editForm = $this->createForm(new CommentType(), $entity);

        return $this->render('NewsBundle:Comment:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Comment entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NewsBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El comentario especificado no existe');
        }

        $editForm = $this->createForm(new CommentType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Los datos del comentario se han modificado exitosamente'
            );

            return $this->redirect($this->generateUrl('comment'));
        }

        return $this->render('NewsBundle:Comment:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Comment entity.
     *
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NewsBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El comentario especificado no existe');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', 'Se ha eliminado el comentario especificado'
        );

        return $this->redirect($this->generateUrl('comment'));
    }
    
    public function publicAction(Request $request, $id) {
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('NewsBundle:Comment')->find($id);

            $entity->setPublish(!$entity->getPublish());
            
            return new Response('OK');
        }
        else
            throw new MethodNotAllowedHttpException('Petición denegada');
    }
    
     public function publishAction(Request $request, $id) {
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('NewsBundle:Comment')->find($id);

            $entity->setPublish(!$entity->getPublish());
            
            $em->flush();
            
            $response = new Response(json_encode(array('state' => $entity->getPublish())));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }
        else
            throw new MethodNotAllowedHttpException('Petición denegada');
    }


}

?>
