<?php

namespace DBOJ\ProblemBundle\Services;

/**
 * Description of Sending
 *
 * @author jdsantana
 */
class Sending {
    
    private $doctrine;
    
    public function __construct($doctrine) {
        $this->doctrine = $doctrine;
    }

    public function setResultSending($id, $result){
        $em = $this->doctrine->getManager();
        
        $entity = $em->getRepository('ProblemBundle:Sending')->find($id);
        
        $entity->setQualification($em->getRepository('CommonBundle:Nomenclator')->findOneBy(array('value' => $result)));
        $em->flush();
    }
    
}
