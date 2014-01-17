<?php

namespace DBOJ\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DBOJ\CommonBundle\Entity\Nomenclator;
use DBOJ\CommonBundle\Form\NomenclatorType;
use DBOJ\CommonBundle\Entity\Catalog;
use DBOJ\CommonBundle\Form\CatalogType;

/**
 * Nomenclator controller.
 *
 */
class NomenclatorController extends Controller
{
    /**
     * Lists all Nomenclator entities.
     *
     */
    public function indexAction()
    {   
        return $this->render('CommonBundle:Nomenclator:index.html.twig');
    }
    
    public function listAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        
        $total = $em->getRepository('CommonBundle:Nomenclator')->getTotal();
        $entities = $em->getRepository('CommonBundle:Nomenclator')->getEntities($request);
        
        $data = array(
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => count($entities),
            'aaData' => array()
        );
        
        foreach($entities as $entity){      
            $data['aaData'][] = array(
                $entity->getCatalog()->getValue(),
                $entity->getValue(),
                $entity->getDescription(),
                $this->renderView('CommonBundle:Extras:option_list.html.twig', array(
                    'path_edit' => 'nomenclator_edit',
                    'path_delete' => 'nomenclator_delete',
                    'title_edit' => 'Editar los datos del nomenclador',
                    'title_delete' => 'Eliminar el nomenclador',
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
     * Creates a new Nomenclator entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Nomenclator();
        $form = $this->createForm(new NomenclatorType(), $entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'El nomenclator se ha adicionado satisfactoriamente'
            );

            return $this->redirect($this->generateUrl('nomenclator'));
        }

        return $this->render('CommonBundle:Nomenclator:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Nomenclator entity.
     *
     */
    public function newAction()
    {
        $entity = new Nomenclator();
        $form   = $this->createForm(new NomenclatorType(), $entity);
        
        $entity_catalog = new Catalog();
        $form_catalog = $this->createForm(new CatalogType(), $entity_catalog);

        return $this->render('CommonBundle:Nomenclator:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'form_catalog' => $form_catalog->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Nomenclator entity.
     *
     */
    public function editAction($id)
    {        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CommonBundle:Nomenclator')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El nomenclador especificado no existe');
        }

        $editForm = $this->createForm(new NomenclatorType(), $entity);
        
        $entity_catalog = new Catalog();
        $form_catalog = $this->createForm(new CatalogType(), $entity_catalog);

        return $this->render('CommonBundle:Nomenclator:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'form_catalog' => $form_catalog->createView()
        ));
    }

    /**
     * Edits an existing Nomenclator entity.
     *
     */
    public function updateAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CommonBundle:Nomenclator')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El nomenclador especificado no existe');
        }
        
        $editForm = $this->createForm(new NomenclatorType(), $entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Los datos del nomenclador se han modificado exitosamente'
            );
            
            return $this->redirect($this->generateUrl('nomenclator'));
        }

        return $this->render('CommonBundle:Nomenclator:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('BackendBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El usuario especificado no existe');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', 'Se ha eliminado el usuario especificado'
        );

        return $this->redirect($this->generateUrl('usuario'));
    }
}
