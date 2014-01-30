<?php

namespace DBOJ\ProblemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DBOJ\CommonBundle\Entity\Nomenclator;

/**
 * Data set for the entity Nomenclator
 *
 * @author jdsantana
 */
class Nomenclators extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
        $nomenclator = array(
            //Nomenclator for sex catalog
            array(
                'value' => 'Calificando',
                'description' => 'Envío en calificación',
                'catalog' => $manager->getRepository('CommonBundle:Catalog')->findOneBy(array('value' => 'EstadoEnvio'))
            ),
            array(
                'value' => 'Tiempo Excedido',
                'description' => 'Envío con tiempo excedido',
                'catalog' => $manager->getRepository('CommonBundle:Catalog')->findOneBy(array('value' => 'EstadoEnvio'))
            ),
            array(
                'value' => 'Memoria excedida',
                'description' => 'Envío con memoria excedida',
                'catalog' => $manager->getRepository('CommonBundle:Catalog')->findOneBy(array('value' => 'EstadoEnvio'))
            ),
            array(
                'value' => 'Aceptado',
                'description' => 'Envío aceptado',
                'catalog' => $manager->getRepository('CommonBundle:Catalog')->findOneBy(array('value' => 'EstadoEnvio'))
            ),
            array(
                'value' => 'Incorrecto',
                'description' => 'Envío incorrecto',
                'catalog' => $manager->getRepository('CommonBundle:Catalog')->findOneBy(array('value' => 'EstadoEnvio'))
            )
        );

        foreach ($nomenclator as $n){
            $nomenclator = new Nomenclator();
            
            $nomenclator->setValue($n['value']);
            $nomenclator->setDescription($n['description']);
            $nomenclator->setCatalog($n['catalog']);
            
            $manager->persist($nomenclator);
        }
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 2;
    }
}

?>
