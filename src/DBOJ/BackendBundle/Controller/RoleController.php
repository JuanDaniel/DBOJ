<?php

namespace DBOJ\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Rol controller.
 *
 */
class RolController extends Controller
{
    /**
     * Lists all Rol entities.
     *
     */
    public function allAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('SeguridadBundle:Rol')->findAll();
        
        $data = array();
        foreach($entities as $entity){
            $data[] = array(
                'id' => $entity->getId(),
                'rol' => $entity->getRol(),
                'descripcion' => $entity->getDescripcion()
            );
        }
        
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
