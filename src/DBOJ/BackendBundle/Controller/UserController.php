<?php

namespace DBOJ\BackendBundle\Controller;

use GECOMET\SeguridadBundle\Entity\User;
use GECOMET\SeguridadBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * User controller.
 *
 */
class UsuarioController extends Controller
{
    /**
     * Lists all User entities.
     *
     */
    public function indexAction()
    {   
        return $this->render('BackendBundle:User:index.html.twig');
    }
    
    public function listAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        
        $total = $em->getRepository('BackendBundle:User')->getTotal();
        $entities = $em->getRepository('BackendBundle:User')->getEntities($request);
        
        $data = array(
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => count($entities),
            'aaData' => array()
        );
        
        foreach($entities as $entity){      
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
     * Creates a new User entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new User();
        $form = $this->createForm(new UserType(), $entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $encoder = $this->container->get('security.encoder_factory')
                    ->getEncoder($entity);
            
            $entity->setClave($encoder->encodePassword($entity->getClave(), null));
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'El usuario se ha agregado exitosamente'
            );

            return $this->redirect($this->generateUrl('usuario'));
        }

        return $this->render('SeguridadBundle:Usuario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createForm(new UserType(), $entity);

        return $this->render('BackendBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id)
    {        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El usuario especificado no existe');
        }

        $editForm = $this->createForm(new UserType(), $entity);

        return $this->render('BackendBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El usuario especificado no existe');
        }
        
        $editForm = $this->createForm(new UserType(), $entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Los datos del usuario se ha modificado exitosamente'
            );
            
            return $this->redirect($this->generateUrl('usuario'));
        }

        return $this->render('BackendBundle:User:edit.html.twig', array(
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
