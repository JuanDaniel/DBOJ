<?php

namespace DBOJ\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Nombre del usuario'
                )
            ))
            ->add('lastname', 'text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Apellidos del usuario'
                )
            ))
            ->add('user', 'text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Nombre de usuario'
                )
            ))
            ->add('email', 'email', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Dirección de correo electrónico'
                )
            ))
            ->add('sex', null, array(
                'attr' => array(
                    'class' => 'form-control',
                    'required' => true
                )
            ))
            ->add('active', null, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('password', 'password', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Clave de acceso'
                ),
            ))
            ->add('role', null, array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Clave de acceso'
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
            'data_class' => 'DBOJ\BackendBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dboj_backendbundle_user';
    }
}
