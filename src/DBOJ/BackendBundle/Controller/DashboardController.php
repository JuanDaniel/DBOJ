<?php

namespace DBOJ\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Administración");
        
        $opciones = array(
            'http'=>array(
                'method'=>"GET",
                'header'=>"Accept-language: en\r\n" .
                    "Cookie: foo=bar\r\n"
            )
        );
        $contexto = stream_context_create($opciones);
        $archivo = file_get_contents('http://localhost:8000/imprime', false, $contexto);

        var_dump($archivo);

        return $this->render('BackendBundle:Dashboard:index.html.twig');
    }
}
