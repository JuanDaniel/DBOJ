<?php

namespace DBOJ\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of ArticleController
 *
 * @author JuanLuis
 */
class ArticleController extends Controller {

    /**
     * Lists all Article entities.
     *
     */
    public function indexAction() {
        return $this->render('NewsBundle:Article:index.html.twig');
    }

    public function listAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $total = $em->getRepository('NewsBundle:Article')->getTotal();
        $entities = $em->getRepository('NewsBundle:Article')->getEntities($request);

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
     * Creates a new Article entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Article();
        $form = $this->createForm(new ArticleType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $encoder = $this->container->get('security.encoder_factory')
                    ->getEncoder($entity);

            $entity->setClave($encoder->encodePassword($entity->getClave(), null));

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'El articulo se ha agregado exitosamente'
            );

            return $this->redirect($this->generateUrl('usuario'));
        }

        return $this->render('NewsBundle:Articulo:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Article entity.
     *
     */
    public function newAction() {
        $entity = new Article();
        $form = $this->createForm(new ArticleType(), $entity);

        return $this->render('NewsBundle:Article:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NewsBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El articulo especificado no existe');
        }

        $editForm = $this->createForm(new ArticleType(), $entity);

        return $this->render('NewsBundle:Article:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Article entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NewsBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El articulo especificado no existe');
        }

        $editForm = $this->createForm(new ArticleType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Los datos del articulo se han modificado exitosamente'
            );

            return $this->redirect($this->generateUrl('article'));
        }

        return $this->render('NewsBundle:Article:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Article entity.
     *
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NewsBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El articulo especificado no existe');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', 'Se ha eliminado el articulo especificado'
        );

        return $this->redirect($this->generateUrl('article'));
    }

}

?>
