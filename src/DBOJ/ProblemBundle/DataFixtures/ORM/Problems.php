<?php

namespace DBOJ\ProblemBundle\DataFixtures\ORM;

use DateTime;
use DBOJ\ProblemBundle\Entity\Problem;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Data set for the entity Problem
 *
 * @author jdsantana
 */
class Problems extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $problems = array(
            array(
                'title' => 'Pablo FG en concierto (a)',
                'description' => file_get_contents(__DIR__ . "/P1/problema.txt"),
                'creationDate' => new DateTime('now'),
                'fileSql' => file_get_contents(__DIR__ . "/P1/canciones.sql"),
                'solution' => file_get_contents(__DIR__ . "/P1/solucion.txt"),
                'nameDatabase' => 'dboj_p1',
                'time' => 10,
                'memory' => 10,
                'publish' => 1,
                'points' => 10
            ),
            array(
                'title' => 'Pablo FG en concierto (b)',
                'description' => file_get_contents(__DIR__ . "/P2/problema.txt"),
                'creationDate' => new DateTime('now'),
                'fileSql' => file_get_contents(__DIR__ . "/P1/canciones.sql"),
                'solution' => file_get_contents(__DIR__ . "/P2/solucion.txt"),
                'nameDatabase' => 'dboj_p1',
                'time' => 10,
                'memory' => 10,
                'publish' => 1,
                'points' => 10
            ),
            array(
                'title' => 'Pablo FG en concierto (c)',
                'description' => file_get_contents(__DIR__ . "/P3/problema.txt"),
                'creationDate' => new DateTime('now'),
                'fileSql' => file_get_contents(__DIR__ . "/P1/canciones.sql"),
                'solution' => file_get_contents(__DIR__ . "/P3/solucion.txt"),
                'nameDatabase' => 'dboj_p1',
                'time' => 10,
                'memory' => 10,
                'publish' => 1,
                'points' => 10
            ),
            array(
                'title' => 'Pablo FG en concierto (d)',
                'description' => file_get_contents(__DIR__ . "/P4/problema.txt"),
                'creationDate' => new DateTime('now'),
                'fileSql' => file_get_contents(__DIR__ . "/P1/canciones.sql"),
                'solution' => file_get_contents(__DIR__ . "/P4/solucion.txt"),
                'nameDatabase' => 'dboj_p1',
                'time' => 10,
                'memory' => 10,
                'publish' => 1,
                'points' => 10
            ),
            array(
                'title' => 'Pablo FG en concierto (e)',
                'description' => file_get_contents(__DIR__ . "/P5/problema.txt"),
                'creationDate' => new DateTime('now'),
                'fileSql' => file_get_contents(__DIR__ . "/P1/canciones.sql"),
                'solution' => file_get_contents(__DIR__ . "/P5/solucion.txt"),
                'nameDatabase' => 'dboj_p1',
                'time' => 10,
                'memory' => 10,
                'publish' => 1,
                'points' => 10
            ),
            array(
                'title' => 'Gestión de Audiovisuales',
                'description' => file_get_contents(__DIR__ . "/P6/problema.txt"),
                'creationDate' => new DateTime('now'),
                'fileSql' => file_get_contents(__DIR__ . "/P6/audiovisuales.sql"),
                'solution' => file_get_contents(__DIR__ . "/P6/solucion.txt"),
                'nameDatabase' => 'dboj_p2',
                'time' => 10,
                'memory' => 10,
                'publish' => 1,
                'points' => 10
            ),
            array(
                'title' => 'Descargas de Internet',
                'description' => file_get_contents(__DIR__ . "/P7/problema.txt"),
                'creationDate' => new DateTime('now'),
                'fileSql' => file_get_contents(__DIR__ . "/P7/descargas.sql"),
                'solution' => file_get_contents(__DIR__ . "/P7/solucion.txt"),
                'nameDatabase' => 'dboj_p3',
                'time' => 10,
                'memory' => 10,
                'publish' => 1,
                'points' => 10
            )
        );

        foreach ($problems as $p) {
            $problem = new Problem();

            $problem->setTitle($p['title']);
            $problem->setDescription($p['description']);
            $problem->setCreationDate($p['creationDate']);
            $problem->setFileSql($p['fileSql']);
            $problem->setSolution($p['solution']);
            $problem->setNameDatabase($p['nameDatabase']);
            $problem->setTime($p['time']);
            $problem->setMemory($p['memory']);
            $problem->setPublish($p['publish']);
            $problem->setPoints($p['points']);
            $manager->persist($problem);
        }

        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }

}

?>
