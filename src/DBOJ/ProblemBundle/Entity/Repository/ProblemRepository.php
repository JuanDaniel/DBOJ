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
class ProblemRepository extends EntityRepository {

    public function getEntities(Request $request) {
        $em = $this->getEntityManager();

        $dql = 'SELECT p FROM ProblemBundle:Problem p';

        $colums = array(
            'p.title',
            'p.creation_date',
            'p.publish',
            'p.name_database',
            'p.time',
            'p.memory'
        );

        //searching
        if (($search = $request->get('sSearch')) != null) {
            $condition = ' WHERE';

            for ($i = 0, $c = count($colums); $i < $c; $i++) {
                $condition .= " " . $colums[$i] . " LIKE '%" . $search . "%'";
                if ($i < $c - 1)
                    $condition .= " OR";
            }

            $dql .= $condition;
        }

        //ordering
        if (($i = $request->get('iSortCol_0')) !== null) {
            $order = ' ORDER BY ' . $colums[$i] . ' ' . $request->get('sSortDir_0');

            $dql .= $order;
        }

        $query = $em->createQuery($dql);


        //paging
        if (($start = $request->get('iDisplayStart')) !== null && ($length = $request->get('iDisplayLength')) != -1) {
            $query->setFirstResult($start);
            $query->setMaxResults($length);
        }

        return new Paginator($query);
    }

    public function getTotal() {
        $em = $this->getEntityManager();

        $dql = 'SELECT COUNT(p.id) FROM ProblemBundle:Problem p';

        $query = $em->createQuery($dql);

        return $query->getSingleScalarResult();
    }

    public function getAccepted($entity) {
        $em = $this->getEntityManager();

        $dql = 'SELECT COUNT(s) FROM ProblemBundle:Sending s JOIN s.problem p JOIN s.qualification q WHERE p = :problem AND q.value = :qualification';
        
        $query = $em->createQuery($dql);
        $query->setParameters(array(
            'problem' => $entity,
            'qualification' => 'Aceptado'
        ));
        
        return $query->getSingleScalarResult();
        
    } 

}

?>
