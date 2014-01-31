<?php

namespace DBOJ\ComunicationBundle\Services;

use DBOJ\ComunicationBundle\Util\Socket;

/**
 * Description of Comunication
 *
 * @author jdsantana
 */
class Comunication {
    
    private $container;
    
    public function __construct($container) {
        $this->container = $container;
    }

    public function send($data){
        $sockect = new Socket($this->container->getParameter('backend.engine.host'), $this->container->getParameter('backend.engine.port'));
        
        $result = $sockect->send($data);
        
        var_dump($result);
    }
}
