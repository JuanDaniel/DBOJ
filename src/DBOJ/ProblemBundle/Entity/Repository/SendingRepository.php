<?php

namespace DBOJ\ProblemBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Description of UserRepository
 *
 * @author jdsantana
 */
class SendingRepository extends EntityRepository {
    
    public function getEntities(Request $request){
        $em = $this->getEntityManager();
        
        $dql = 'SELECT s FROM ProblemBundle:Sending s JOIN s.user u JOIN s.problem p';
        
        $colums = array(
            's.sendingDate',
            's.qualification',
            's.time',
            's.memory',
            'u.user',
            'p.title'
        );
        
        //searching
        if(($search = $request->get('sSearch')) != null){
            $condition = ' WHERE';
            
            for($i=0, $c=count($colums); $i<$c; $i++){
                $condition .= " " . $colums[$i] . " LIKE '%" . $search . "%'";
                if($i < $c-1)
                    $condition .= " OR";
            }
            
            $dql .= $condition;
        }
        
        //ordering
        if(($i = $request->get('iSortCol_0')) !== null){
            $order = ' ORDER BY ' . $colums[$i] . ' ' . $request->get('sSortDir_0');

            $dql .= $order;
        }
        else{
            $dql .= ' ORDER BY s.sendingDate DESC';
        }
        
        $query = $em->createQuery($dql);
        
        //paging
        if(($start = $request->get('iDisplayStart')) !== null && ($length = $request->get('iDisplayLength')) != -1){
            $query->setFirstResult($start);
            $query->setMaxResults($length);
        }
        
        return new Paginator($query);
    }    
    
    public function getTotal(){
        $em = $this->getEntityManager();
        
        $dql = 'SELECT COUNT(s.id) FROM ProblemBundle:Sending s';
        
        $query = $em->createQuery($dql);
        
        return $query->getSingleScalarResult();
    }
    
    public function getAcceptedByUser($entity){
        $em = $this->getEntityManager();

        $dql = 'SELECT COUNT(s) FROM ProblemBundle:Sending s WHERE s.user = :user AND s.qualification = :qualification';
        
        $query = $em->createQuery($dql);
        $query->setParameters(array(
            'user' => $entity->getId(),
            'qualification' => 1
        ));
        
        return $query->getSingleScalarResult();
    }
    
    public function getTotalSending($entity){
        $em = $this->getEntityManager();

        $dql = 'SELECT COUNT(s) FROM ProblemBundle:Sending s WHERE s.user = :user';
        
        $query = $em->createQuery($dql);
        $query->setParameters(array(
            'user' => $entity->getId()
        ));
        
        return $query->getSingleScalarResult();
    }
    
    
}

?>
