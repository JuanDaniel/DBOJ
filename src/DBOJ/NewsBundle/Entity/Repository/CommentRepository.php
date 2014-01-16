<?php

namespace DBOJ\NewsBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Description of CommentRepository
 *
 * @author JuanLuis
 */
class CommentRepository extends EntityRepository {

    public function getEntities(Request $request) {
        $em = $this->getEntityManager();

        $dql = 'SELECT c FROM NewsBundle:Comment c JOIN c.article a JOIN c.user u';

        $colums = array(
            'a.article',
            'u.user'
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

        $dql = 'SELECT COUNT(c.id) FROM NewsBundle:Comment c';

        $query = $em->createQuery($dql);

        return $query->getSingleScalarResult();
    }

}

?>
