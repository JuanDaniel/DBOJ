<?php

namespace DBOJ\CommonBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DBOJ\CommonBundle\Entity\Catalog;

/**
 * Data set for the entity Catalog
 *
 * @author jdsantana
 */
class Catalogs extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
        $catalogs = array(
          array(
              'value' => 'Sexo',
              'description' => 'Catálogo para almacenar los nomencladores para sexo'
          )  
        );
        
        foreach ($catalogs as $c){
            $catalog = new Catalog();
            
            $catalog->setValue($c['value']);
            $catalog->setDescription($c['description']);
            
            $manager->persist($catalog);
        }
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 1;
    }
}

?>
