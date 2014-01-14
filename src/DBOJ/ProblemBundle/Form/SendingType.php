<?php

namespace DBOJ\ProblemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SendingType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sendingDate','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Sending date'
                )
            ))
            ->add('answer','textarea', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Solution'
                )
            ))
            ->add('time','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Sending time'
                )
            ))
            ->add('memory','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Sending memory'
                )
            ))
            ->add('user', null, array(
                'attr' => array(
                    'class' => 'form-control',
                    'required' => true
                ),
                'empty_value' => '-Select a user-'
            ))
            ->add('problem',null, array(
                'attr' => array(
                    'class' => 'form-control',
                    'required' => true
                ),
                'empty_value' => '-Select a problem-'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DBOJ\ProblemBundle\Entity\Sending'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dboj_problembundle_sending';
    }
}
