<?php

namespace DBOJ\NewsBundle\Controller;

use DateTime;
use DBOJ\NewsBundle\Entity\Article;
use DBOJ\NewsBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Form\FormError;
use DBOJ\CommonBundle\Util\Urlizer;

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
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Administración", $this->generateUrl('dashboard'));
        $breadcrumbs->addItem("Artículos");    
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

        foreach ($entities as $entity) {
            $data['aaData'][] = array(
                $entity->getTitle(),
                $entity->getPublicationDate()->format('Y-m-d H:i:s'),
                $entity->getPublish() ? 'Publicado' : 'No publicado',
                $entity->getUser()->getUser(),
                $this->renderView('CommonBundle:Extras:option_list.html.twig', array(
                    'path_edit' => 'article_edit',
                    'path_delete' => 'article_delete',
                    'title_edit' => 'Editar los datos del articulo',
                    'title_delete' => 'Eliminar el articulo',
                    'msg_confirm' => '¿Desea realmente eliminar el articulo?',
                    'state' => $entity->getPublish(),
                    'entity' => $entity,
                    'extras' => array(
                        array(
                            'path' => 'article_change_state',
                            'parameters' => array(
                                'id' => $entity->getId()
                            ),
                            'title' => $entity->getPublish() ? 'Despublicar el artículo' : 'Publicar el artículo',
                            'icon' => $entity->getPublish() ? 'fa fa-thumbs-o-up' : 'fa fa-thumbs-o-down',
                            'onclick' => 'return changeState(this);'
                        )
                    )
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

        $entity->setSlug(Urlizer::urlize($entity->getTitle()));
        $entity->setUser($this->get('security.context')->getToken()->getUser());
        $entity->setCreationDate(new DateTime('new'));
        if ($entity->getPublicationDate() == new DateTime('now')) {
            $entity->setPublish(true);
        } else {
            $entity->setPublish(false);
        }
        if (!$entity->getContent()) {
            $form->get('content')->addError(new FormError(
                    'El envío contiene datos de error'
            ));
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'El artículo se ha agregado exitosamente'
            );

            return $this->redirect($this->generateUrl('article'));
        }

        return $this->render('NewsBundle:Article:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Article entity.
     *
     */
    public function newAction() {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Administración", $this->generateUrl('dashboard'));
        $breadcrumbs->addItem("Artículos", $this->generateUrl('article')); 
        $breadcrumbs->addItem("Registrar artículo");
        
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
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Administración", $this->generateUrl('dashboard'));
        $breadcrumbs->addItem("Artículos", $this->generateUrl('article')); 
        $breadcrumbs->addItem("Editar artículo");
        
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

        $entity->setSlug(Urlizer::urlize($entity->getTitle()));
        
        if (!$entity->getContent()) {
            $editForm->get('content')->addError(new FormError(
                    'El envío contiene datos de error'
            ));
        }

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

    public function changeStateAction(Request $request, $id) {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('NewsBundle:Article')->find($id);

            $entity->setPublish(!$entity->getPublish());

            $em->flush();

            $response = new Response(json_encode(array('state' => $entity->getPublish())));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        } else
            throw new MethodNotAllowedHttpException('Petición denegada');
    }

}

?>
