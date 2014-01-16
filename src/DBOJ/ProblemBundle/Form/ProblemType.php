<?php

namespace DBOJ\ProblemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProblemType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Título del problema'
                )
            ))
            ->add('description','textarea', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Descripción del problema'
                )
            ))
            ->add('creationDate','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Fecha de creación'
                )
            ))
            ->add('active','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Estado del problema'
                )
            ))
            ->add('fileSql','textarea', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Esquema de la base de datos'
                )
            ))
            ->add('solution','textarea', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Solución maestra'
                )
            ))
            ->add('nameDatabase','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Base de datos asociada'
                )
            ))
            ->add('time','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Tiempo de ejecución'
                )
            ))
            ->add('memory','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Memoria'
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DBOJ\ProblemBundle\Entity\Problem'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dboj_problembundle_problem';
    }
}
