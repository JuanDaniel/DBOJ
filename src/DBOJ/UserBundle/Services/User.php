<?php

namespace DBOJ\UserBundle\Services;

use DBOJ\UserBundle\Entity\User;

/**
 * Description of UserPoints
 *
 * @author jdsantana
 */
class User {
    public function getRankInfo(User $user){
        $sendings = $user->getSendings();
        
        $info = array(
            'points' => 0,
            'acepted' => 0,
            'avg_acepted' => 0,
        );
        
        if($sendings){
            foreach($sendings as $sending){
                if($sending->getQualification()->getValue() == 'Aceptado'){
                    $info['points'] += $sending->getProblem()->getPoints();
                    $info['acepted']++;
                }
            }
            
            $info['avg_acepted'] = $info['acepted'] / count($sendings) * 100;
        }
        
        return $info;
    }
}
