<?php

namespace DBOJ\BackendBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DBOJ\BackendBundle\Entity\User;

/**
 * Data set for the entity User
 *
 * @author jdsantana
 */
class Users extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
        $users = array(
            array(
                'name' => 'Yaniel',
                'lastname' => 'Blanco Fernández',
                'user' => 'yblancof',
                'email' => 'yblancof@estudiantes.uci.cu',
                'sex' => 'M',
                'active' => true,
                'password' => 'yblancof',
                'role' => $manager->getRepository('BackendBundle:Role')->findOneBy(array('role' => 'ROLE_ADMIN'))
            ),
            array(
                'name' => 'Juan Daniel',
                'lastname' => 'Santana Rodés',
                'user' => 'jdsantana',
                'email' => 'jdsantana@estudiantes.uci.cu',
                'sex' => 'M',
                'active' => true,
                'password' => 'jdsantana',
                'role' => $manager->getRepository('BackendBundle:Role')->findOneBy(array('role' => 'ROLE_ADMIN'))
            ),
            array(
                'name' => 'Juan Luis',
                'lastname' => 'Paneque Perez',
                'user' => 'jlpaneque',
                'email' => 'jlpaneque@estudiantes.uci.cu',
                'sex' => 'M',
                'active' => true,
                'password' => 'jlpaneque',
                'role' => $manager->getRepository('BackendBundle:Role')->findOneBy(array('role' => 'ROLE_ADMIN'))
            ),array(
                'name' => 'Adrian',
                'lastname' => 'Sosa Benítez',
                'user' => 'asosa',
                'email' => 'asosa@estudiantes.uci.cu',
                'sex' => 'M',
                'active' => true,
                'password' => 'asosa',
                'role' => $manager->getRepository('BackendBundle:Role')->findOneBy(array('role' => 'ROLE_ADMIN'))
            )
        );
        
        foreach ($users as $u){
            $user = new User();
            
            $user->setName($u['name']);
            $user->setLastname($u['lastname']);
            $user->setUser($u['user']);
            $user->setEmail($u['email']);
            $user->setSex($u['sex']);
            $user->setActive($u['active']);
            $user->setPassword($u['password']);
            $user->setRole($u['role']);
            $user->setRegistrerDate(new \DateTime('now'));
            $user->setVisitDate(new \DateTime('now'));
            
            $manager->persist($user);
        }
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 2;
    }
}

?>
