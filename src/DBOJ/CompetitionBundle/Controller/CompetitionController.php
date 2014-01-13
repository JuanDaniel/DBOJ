<?php

namespace DBOJ\CompetitionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompetitionController extends Controller {

    public function indexAction() {
        return $this->render('CompetitionBundle:Competition:index.html.twig');
    }

    public function listAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $total = $em->getRepository('CompetitionBundle:Competition')->getTotal();
        $entities = $em->getRepository('CompetitionBundle:Competition')->getEntities($request);

        $data = array(
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => count($entities),
            'aaData' => array()
        );

        foreach ($entities as $entity) {
            $data['aaData'][] = array(
                $entity->getNombre(),
                $entity->getApellidos(),
                $entity->getUsuario(),
                $entity->getCorreo(),
                $entity->getRol()->getRol(),
                $entity->getArea() ? $entity->getArea()->getNombre() : '----',
                $this->renderView('CentralBundle:Extras:option_list.html.twig', array(
                    'path_edit' => 'competition_edit',
                    'path_delete' => 'competition_delete',
                    'title_edit' => 'Edit data of competition',
                    'title_delete' => 'Remove competition',
                    'msg_confirm' => 'Do you really want to eliminate competition?',
                    'entity' => $entity
                ))
            );
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
