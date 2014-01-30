<?php

namespace DBOJ\FrontendBundle\Controller;

use DBOJ\UserBundle\Form\Frontend\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DBOJ\UserBundle\Entity\User;

class UserController extends Controller {

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
            
            $em = $this->getDoctrine()->getManager();
            
            $entity->setPassword($encoder->encodePassword($entity->getPassword(), null));
            $entity->setRegistrerDate(new \DateTime('now'));
            $entity->setActive(false);
            $entity->setRole($em->getRepository('UserBundle:Role')->findOneBy(
                    array(
                        'role'=>'ROLE_USER'
                    )
            ));
            
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'El usuario se ha agregado exitosamente. Se le ha enviado un mensaje de activación a su cuenta correo.'
            );

            return $this->redirect($this->generateUrl('frontendBundle_home'));
        }

        return $this->forward('FrontendBundle:Default:login');
    }    
}
