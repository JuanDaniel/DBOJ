<?php

namespace DBOJ\UserBundle\Controller;

use DateTime;
use DBOJ\UserBundle\Entity\User;
use DBOJ\UserBundle\Form\Backend\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     *
     */
    public function indexAction()
    {   
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Administración", $this->generateUrl('dashboard'));
        $breadcrumbs->addItem("Usuarios");
        
        return $this->render('UserBundle:Backend:index.html.twig');
    }
    
    public function listAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        
        $total = $em->getRepository('UserBundle:User')->getTotal();
        $entities = $em->getRepository('UserBundle:User')->getEntities($request);
        
        $data = array(
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => count($entities),
            'aaData' => array()
        );
        
        foreach($entities as $entity){      
            $data['aaData'][] = array(
                $entity->getName(),
                $entity->getLastName(),
                $entity->getUser(),
                $entity->getEmail(),
                $entity->getActive() ? 'si' : 'no',
                $entity->getRole()->getName(),
                $this->renderView('CommonBundle:Extras:option_list.html.twig', array(
                    'path_edit' => 'user_edit',
                    'path_delete' => 'user_delete',
                    'title_edit' => 'Editar los datos del usuario',
                    'title_delete' => 'Eliminar el usuario',
                    'msg_confirm' => '¿Desea realmente eliminar el usuario?',
                    'entity' => $entity,
                    'extras' => array(
                        array(
                            'path' => 'user_change_active',
                            'parameters' => array(
                                'id' => $entity->getId()
                            ),
                            'title' => $entity->getActive() ? 'Desactivar el usuario' : 'Activar el usuario',
                            'icon' => $entity->getActive() ? 'fa fa-unlock' : 'fa fa-unlock-alt',
                            'onclick' => 'return changeActive(this);'
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
            
            $entity->setPassword($encoder->encodePassword($entity->getPassword(), null));
            $entity->setActive(true);
            $entity->setRegistrerDate(new DateTime('now'));
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'El usuario se ha agregado exitosamente'
            );

            return $this->redirect($this->generateUrl('user'));
        }

        return $this->render('UserBundle:Backend:new.html.twig', array(
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
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Administración", $this->generateUrl('dashboard'));
        $breadcrumbs->addItem("Usuarios", $this->generateUrl('user'));
        $breadcrumbs->addItem("Registrar nuevo");
        
        $entity = new User();
        $form   = $this->createForm(new UserType(), $entity);

        return $this->render('UserBundle:Backend:new.html.twig', array(
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
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Administración", $this->generateUrl('dashboard'));
        $breadcrumbs->addItem("Usuarios", $this->generateUrl('user'));
        $breadcrumbs->addItem("Editar");
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El usuario especificado no existe');
        }

        $editForm = $this->createForm(new UserType(), $entity);

        return $this->render('UserBundle:Backend:edit.html.twig', array(
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

        $entity = $em->getRepository('UserBundle:User')->find($id);

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
            
            return $this->redirect($this->generateUrl('user'));
        }

        return $this->render('UserBundle:User:edit.html.twig', array(
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
        
        $entity = $em->getRepository('UserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El usuario especificado no existe');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', 'Se ha eliminado el usuario especificado'
        );

        return $this->redirect($this->generateUrl('user'));
    }
    
    public function changeActiveAction(Request $request, $id){
        if(!$request->isXmlHttpRequest())
            throw new MethodNotAllowedException('El método para acceder no está permitido');
        
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('UserBundle:User')->find($id);
        
        if(!$entity)
            return $this->createNotFoundException('El usuario especificado no existe');
        
        $entity->setActive(!$entity->getActive());
        
        $em->flush();
        
        $response = new Response(json_encode(array('active' => $entity->getActive())));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
    
    /**
     * Change the password from an user
     */
    public function changePassAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('UserBundle:User')->find($id);
        
        if(!$entity){
            throw $this->createNotFoundException('El usuario especificado no existe');
        }
        
        if($request->isXmlHttpRequest()){
            if($request->getMethod() == 'POST'){
                $password = $request->get('password');
                $password_confirm = $request->get('password_confirm');
                
                if($password === ''){
                    $response = new Response(json_encode(array(
                                'type' => 'error',
                                'msg' => 'El valor de la clave no puede ser vacío'
                    )));
                    $response->headers->set('Content-Type', 'application/json');

                    return $response;
                }
                
                if($password_confirm !== null)
                    if($password != $password_confirm){
                        $response = new Response(json_encode(array(
                                    'type' => 'error',
                                    'msg' => 'Las claves no coinciden, rectifíquelas'
                        )));
                        $response->headers->set('Content-Type', 'application/json');

                        return $response;
                    }

                $factory = $this->container->get('security.encoder_factory');
                $encoder = $factory->getEncoder($entity);

                $entity->setPassword($encoder->encodePassword($password, null));
                
                $em->flush();
                
                $response = new Response(json_encode(array(
                            'type' => 'success',
                            'msg' => 'La clave se cambió exitosamente'
                )));
                $response->headers->set('Content-Type', 'application/json');

                return $response;
            }
            else
                throw new MethodNotAllowedException('El método para acceder no está permitido');
        }
        else
            throw new NotFoundHttpException('La ruta solicitada no existe');  
    }
}
