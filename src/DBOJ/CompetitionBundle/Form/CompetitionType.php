<?php

namespace DBOJ\CompetitionBundle\Form;

use DBOJ\CommonBundle\Form\CatalogType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompetitionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Nombre de la competencia'
                )
            ))
            ->add('description','textarea', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Descripción de la competencia '
                )
            ))
            ->add('creationDate','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Fecha de creación'
                )
            ))
            ->add('startDate','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Fecha de inicio'
                )
            ))
            ->add('duration','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Duración'
                )
            ))
            ->add('state', 'entity', CatalogType::Type('Common:Country',
                array(
                    'class' => 'form-control',
                    'empty_value'=> 'Seleccione el estado de la competencia'
                )
            ))
            ->add('type','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Tipo de competencia'
                )
            ))
            ->add('timeOut','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Tiempo muerto'
                )
            ))
            ->add('timeFrozen','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Tiempo congelado'
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
            'data_class' => 'DBOJ\CompetitionBundle\Entity\Competition'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dboj_competitionbundle_competition';
    }
}
