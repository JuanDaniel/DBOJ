<?php

namespace DBOJ\ProblemBundle\Services;

/**
 * Description of Problem
 *
 * @author jdsantana
 */
class Problem {
    
    private $doctrine;
    
    public function __construct($doctrine) {
        $this->doctrine = $doctrine;
    }

    public function getProblem($id){
        $em = $this->doctrine->getManager();
        
        $entity = $em->getRepository('ProblemBundle:Problem')->find($id);
        
        return $entity;
    }
    
}
