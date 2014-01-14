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
                    'placeholder' => 'Problem title'
                )
            ))
            ->add('description','textarea', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Problem descripcion'
                )
            ))
            ->add('creationDate','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Problem date creation'
                )
            ))
            ->add('active','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Problem status'
                )
            ))
            ->add('fileSql','textarea', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Problem schema'
                )
            ))
            ->add('solution','textarea', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Problem schema'
                )
            ))
            ->add('nameDatabase','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Database name'
                )
            ))
            ->add('time','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Problem time'
                )
            ))
            ->add('memory','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Problem memory'
                )
            ))
            ->add('competition', null, array(
                'attr' => array(
                    'class' => 'form-control',
                    'required' => true
                ),
                'empty_value' => '-Select a competition-'
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
