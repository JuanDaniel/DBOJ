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
            ->add('nombre', 'text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Nombre del usuario'
                )
            ))
            ->add('apellidos', 'text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Apellidos del usuario'
                )
            ))
            ->add('usuario', 'text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Nombre de usuario'
                )
            ))
            ->add('correo', 'email', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Dirección de correo electrónico'
                )
            ))
            ->add('rol', null, array(
                'attr' => array(
                    'class' => 'form-control',
                    'required' => true
                ),
                'empty_value' => '-Seleccione un rol-'
            ))
            ->add('area', null, array(
                'attr' => array(
                    'class' => 'form-control'
                ),
                'empty_value' => '-Seleccione un área-'
            ))
            ->add('clave', 'password', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Clave de acceso'
                ),
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
