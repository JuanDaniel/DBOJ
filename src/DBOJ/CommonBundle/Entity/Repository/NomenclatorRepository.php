<?php

namespace DBOJ\CommonBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;

/**
 * NomenclatorRepository
 */
class NomenclatorRepository extends EntityRepository
{
    public function getEntities(Request $request){
        $em = $this->getEntityManager();
        
        $dql = 'SELECT n FROM CommonBundle:Nomenclator n JOIN n.catalog c';
        
        $colums = array(
            'c.value',
            'n.value',
            'n.description'
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
        
        $dql = 'SELECT COUNT(n.id) FROM CommonBundle:Nomenclator n';
        
        $query = $em->createQuery($dql);
        
        return $query->getSingleScalarResult();
    }
    
    public function findNomenclator($catalog_value, $nomenclator_value)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT n FROM CommonBundle:Nomenclator n LEFT JOIN n.catalog c WHERE c.value = :catalog_value AND n.value = :nomenclator_value');
        $query->setParameter('catalog_value',$catalog_value);
        $query->setParameter('nomenclator_value', $nomenclator_value);

        return $query->getOneOrNullResult();

    }

    public function findByCatalog($catalog_value)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT n FROM CommonBundle:Nomenclator n LEFT JOIN n.catalog c WHERE c.value = :catalog_value');
        $query->setParameter('catalog_value',$catalog_value);

        return $query->getResult();

    }
}
