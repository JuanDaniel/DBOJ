<?php

namespace DBOJ\CommonBundle\DataFixtures\ORM;

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
                'value' => 'Femenino',
                'description' => '',
                'catalog' => $manager->getRepository('CommonBundle:Catalog')->findOneBy(array('value' => 'Sexo'))
            ),
            array(
                'value' => 'Masculino',
                'description' => '',
                'catalog' => $manager->getRepository('CommonBundle:Catalog')->findOneBy(array('value' => 'Sexo'))
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
