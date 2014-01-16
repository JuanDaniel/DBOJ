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
        /*DUDA DE QUE ES ESTO*/
        foreach ($entities as $entity) {
            $data['aaData'][] = array(
                $entity->getNombre(),
                $entity->getApellidos(),
                $entity->getUsuario(),
                $entity->getCorreo(),
                $entity->getRol()->getRol(),
                $entity->getArea() ? $entity->getArea()->getNombre() : '----',
                $this->renderView('CentralBundle:Extras:option_list.html.twig', array(
                    'path_edit' => 'usuario_edit',
                    'path_delete' => 'usuario_delete',
                    'title_edit' => 'Editar los datos del usuario',
                    'title_delete' => 'Eliminar el usuario',
                    'msg_confirm' => '¿Desea realmente eliminar el usuario?',
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

        /*DUDA A PARTIR DE AKI*/
        
        if ($form->isValid()) {
            $encoder = $this->container->get('security.encoder_factory')
                    ->getEncoder($entity);

            $entity->setClave($encoder->encodePassword($entity->getClave(), null));

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'El comentario se ha agregado exitosamente'
            );

            return $this->redirect($this->generateUrl('usuario'));
        }

        return $this->render('NewsBundle:Articulo:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Comment entity.
     *
     */
    public function newAction() {
        $entity = new Comment();
        $form = $this->createForm(new CommentType(), $entity);

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

}

?>
