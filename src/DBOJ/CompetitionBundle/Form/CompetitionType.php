<?php

namespace DBOJ\CompetitionBundle\Form;

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
                    'placeholder' => 'Competition name'
                )
            ))
            ->add('description','textarea', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Competition descripcion'
                )
            ))
            ->add('creationDate','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Competition cration date'
                )
            ))
            ->add('startDate','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Competition start date'
                )
            ))
            ->add('duration','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Competition duration'
                )
            ))
            ->add('active',null, array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Competition duration'
                )
            ))
            ->add('type','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Competition type'
                )
            ))
            ->add('timeOut','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Competition timeout'
                )
            ))
            ->add('timeFrozen','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Competition time frozen'
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
