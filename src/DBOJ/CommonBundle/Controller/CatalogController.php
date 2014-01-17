<?php

namespace DBOJ\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DBOJ\CommonBundle\Entity\Catalog;
use DBOJ\CommonBundle\Form\CatalogType;

/**
 * Catalog controller.
 *
 */
class CatalogController extends Controller {

    /**
     * Creates a new Catalog entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Catalog();
        $form = $this->createForm(new CatalogType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'El catálogo se ha adicionado satisfactoriamente'
            );
        } else {
            $this->get('session')->getFlashBag()->add(
                    'error', 'Se produjo un error al adicionar el nuevo catálogo'
            );
        }

        if (($from = $request->get('dboj_commonbundle_from')))
            return $this->redirect($from);

        return $this->redirect($this->generateUrl('catalog'));
    }

}
