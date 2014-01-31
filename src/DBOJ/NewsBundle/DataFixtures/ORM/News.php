<?php

namespace DBOJ\NewsBundle\DataFixtures\ORM;

use DateTime;
use DBOJ\CommonBundle\Util\Urlizer;
use DBOJ\NewsBundle\Entity\Article;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Data set for the entity Problem
 *
 * @author jdsantana
 */
class News extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $news = array(
            array(
                'title' => 'Jurado Online de Bases de Datos',
                'slug' => Urlizer::urlize('Jurado Online de Bases de Datos'),
                'content' => 'La asignatura Sistemas de Bases de Datos I persigue preparar al estudiante en los conceptos básicos de Sistemas Relacionales, en el diseño de Sistemas de Bases de Datos Relacionales con propiedades definidas y en la asimilación y utilización del lenguaje SQL estándar a través de un lenguaje concreto. ',
                'tags' => 'basedatos',
                'creationDate' => new DateTime('now'),
                'publicationDate' => new DateTime('now'),
                'user' => $manager->getRepository('UserBundle:User')->find(1),
                'publish' => 1
            ),
            array(
                'title' => 'Avisos de ultima hora',
                'slug' => Urlizer::urlize('Avisos de ultima hora'),
                'content' => 'En este espacio de ¡¡AVISO!!, se publicarán con antelación los objetivos de cada actividad evaluativa parcial o final de la asignatura; así como ejercicios, temarios anteriores y otros materiales que sirvan para la preparación individual de los estudiantes en los temas correspondientes.',
                'tags' => 'avisos',
                'creationDate' => new DateTime('now'),
                'publicationDate' => new DateTime('now'),
                'user' => $manager->getRepository('UserBundle:User')->find(1),
                'publish' => 1
            ),
            array(
                'title' => 'Sistema de habilidades',
                'slug' => Urlizer::urlize('Avisos de ultima hora'),
                'content' => 'Sistema de habilidades:
    Elaborar expresiones en los lenguajes de Álgebra Relacional y Cálculo Relacional, que permitan manipular la información de un Modelo de Datos Relacional.
    Utilizar el lenguaje SQL para crear una Base de Datos Relacional y manipular la información que en ella se almacene.
    Programar algoritmos para la solución de problemas específicos que permitan lograr sistemas eficientes.
    Utilizar un SGBD específico para crear e interactuar con una Base de Datos.
',
                'tags' => 'sistemas',
                'creationDate' => new DateTime('now'),
                'publicationDate' => new DateTime('now'),
                'user' => $manager->getRepository('UserBundle:User')->find(1),
                'publish' => 1
            )
        );

        foreach ($news as $n) {
            $new = new Article();

            $new->setTitle($n['title']);
            $new->setContent($n['content']);
            $new->setCreationDate($n['creationDate']);
            $new->setPublicationDate($n['publicationDate']);
            $new->setTags($n['tags']);
            $new->setSlug($n['slug']);
            $new->setPublish($n['publish']);
            $new->setUser($n['user']);
            $manager->persist($new);
        }

        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }

}

?>
