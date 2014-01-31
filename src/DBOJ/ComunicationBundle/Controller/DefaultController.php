<?php

namespace DBOJ\ComunicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $action = $request->get('action');
        $parameters = json_decode($request->get('parameters'));
        
        if($action == 'setResultSending'){            
            $this->get('dboj.sending')->setResultSending($parameters->id, $parameters->qualifield);
        }
        else if($action == 'getSchema'){
            $problem = $this->get('dboj.problem')->getProblem($parameters->id);
            
            $data = array(
                'schema' => $problem->getFileSql()
                );
            $response = new Response(json_encode($data));
            $response->headers->set('Content-Type', 'application/json');
                        
            return $response;
        }
        
        return new Response('OK');
    }
}
