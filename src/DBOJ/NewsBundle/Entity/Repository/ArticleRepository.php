<?php

namespace DBOJ\NewsBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Description of ArticleRepository
 *
 * @author JuanLuis
 */
class ArticleRepository extends EntityRepository {

    public function getEntities(Request $request) {
        $em = $this->getEntityManager();

        $dql = 'SELECT a FROM NewsBundle:Article a JOIN a.user u';

        $colums = array(
            'a.title',
            'a.creationDate',
            'a.publicationDate',            
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

        $dql = 'SELECT COUNT(a.id) FROM NewsBundle:Article a';

        $query = $em->createQuery($dql);

        return $query->getSingleScalarResult();
    }

}
?>
