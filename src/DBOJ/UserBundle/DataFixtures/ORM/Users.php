<?php

namespace DBOJ\UserBundle\DataFixtures\ORM;

use DBOJ\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Data set for the entity User
 *
 * @author jdsantana
 */
class Users extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface {
    
    private $container;
    
    public function load(ObjectManager $manager) {
        $users = array(
            array(
                'name' => 'Yaniel',
                'lastname' => 'Blanco Fernández',
                'user' => 'yblancof',
                'email' => 'yblancof@estudiantes.uci.cu',
                'sex' => $manager->getRepository('CommonBundle:Nomenclator')->findOneBy(array('value' => 'Masculino')),
                'active' => true,
                'password' => 'yblancof',
                'role' => $manager->getRepository('UserBundle:Role')->findOneBy(array('role' => 'ROLE_ADMIN'))
            ),
            array(
                'name' => 'Juan Daniel',
                'lastname' => 'Santana Rodés',
                'user' => 'jdsantana',
                'email' => 'jdsantana@estudiantes.uci.cu',
                'sex' => $manager->getRepository('CommonBundle:Nomenclator')->findOneBy(array('value' => 'Masculino')),
                'active' => true,
                'password' => 'jdsantana',
                'role' => $manager->getRepository('UserBundle:Role')->findOneBy(array('role' => 'ROLE_ADMIN'))
            ),
            array(
                'name' => 'Juan Luis',
                'lastname' => 'Paneque Perez',
                'user' => 'jlpaneque',
                'email' => 'jlpaneque@estudiantes.uci.cu',
                'sex' => $manager->getRepository('CommonBundle:Nomenclator')->findOneBy(array('value' => 'Masculino')),
                'active' => true,
                'password' => 'jlpaneque',
                'role' => $manager->getRepository('UserBundle:Role')->findOneBy(array('role' => 'ROLE_ADMIN'))
            ),array(
                'name' => 'Adrian',
                'lastname' => 'Sosa Benítez',
                'user' => 'asosa',
                'email' => 'asosa@estudiantes.uci.cu',
                'sex' => $manager->getRepository('CommonBundle:Nomenclator')->findOneBy(array('value' => 'Masculino')),
                'active' => true,
                'password' => 'asosa',
                'role' => $manager->getRepository('UserBundle:Role')->findOneBy(array('role' => 'ROLE_ADMIN'))
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
            
            $factory = $this->container->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $user->setPassword($encoder->encodePassword($u['password'], null));
            
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
    
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
}

?>
