<?php

namespace DBOJ\FrontendBundle\Controller;

use DBOJ\ProblemBundle\Form\SendingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProblemController extends Controller {

    public function indexAction() {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Inicio", $this->generateUrl('frontendBundle_home'));
        $breadcrumbs->addItem("Problemas");

        return $this->render("ProblemBundle:Frontend:index_problem.html.twig");
    }

    public function listAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $total = $em->getRepository('ProblemBundle:Problem')->getTotal();

        $entities = $em->getRepository('ProblemBundle:Problem')->getEntities($request);

        $data = array(
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => count($entities),
            'aaData' => array()
        );

        foreach ($entities as $entity) {
            if ($entity->getPublish()) {
                $accept = $em->getRepository('ProblemBundle:Problem')->getAccepted($entity);
                $data['aaData'][] = array(
                    $entity->getId(),
                    sprintf('<a href="%s">%s</a>', $this->generateUrl('frontend_problem_show', array('id' => $entity->getId())), $entity->getTitle()),
                    count($entity->getSendings()),
                    $accept,
                    count($entity->getSendings())==0?0:($accept / count($entity->getSendings())) * 100,                                        
                    $entity->getPoints()
                );
            }
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createForm(new SendingType());

        $entity = $em->getRepository('ProblemBundle:Problem')->find($id);

        $accept = $em->getRepository('ProblemBundle:Problem')->getAccepted($entity);
        $total =  $em->getRepository('ProblemBundle:Problem')->getTotal();

        if (!$entity)
            throw $this->createNotFoundException('No existe el problema especificado');

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Inicio", $this->generateUrl('frontendBundle_home'));
        $breadcrumbs->addItem("Ejercicios", $this->generateUrl('frontend_problem_index'));
        $breadcrumbs->addItem($entity->getTitle());
        
        include_once __DIR__.'\..\Util\geshi\geshi.php';
        $geshi = new \GeSHi($entity->getFileSql(), 'plsql');
        
        return $this->render('ProblemBundle:Frontend:show.html.twig', array(
                    'entity' => $entity,
                    'sql' => $geshi->parse_code(),
                    'accept' => $accept,
                    'total'  => $total,
                    'form' => $form->createView()
        ));
    }

}
