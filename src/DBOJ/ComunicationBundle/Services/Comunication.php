<?php

namespace DBOJ\ComunicationBundle\Services;

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

    public function send($action, $method='POST', $parameters=null){
        
    }
}
