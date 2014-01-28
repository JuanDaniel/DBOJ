<?php

namespace DBOJ\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DBOJ\UserBundle\Entity\Role;

/**
 * Data set for the entity Role
 *
 * @author jdsantana
 */
class Roles extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
        $roles = array(
            array(
                'role' => 'ROLE_ADMIN',
                'name' => 'Administrador',
                'description' => 'Administrador del sistema'
            ),
            array(
                'role' => 'ROLE_USER',
                'name' => 'Usuario',
                'description' => 'Usuario básico del sistema'
            )
        );
        
        foreach ($roles as $r){
            $role = new Role();
            
            $role->setRole($r['role']);
            $role->setName($r['name']);
            $role->setDescription($r['description']);
            
            $manager->persist($role);
        }
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 1;
    }
}

?>
