<?php

namespace DBOJ\UserBundle\Form\Frontend;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{    
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
     public function buildForm(FormBuilderInterface $builder, array $options) {
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
                ->add('sex', 'entity', array(
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'required' => true,
                    'class' => 'CommonBundle:Nomenclator',
                    'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('n')
                        ->leftJoin('n.catalog', 'c')
                        ->where('c.value = :catalog')
                        ->setParameter('catalog', 'Sexo');
            },
                    'empty_value' => '-Seleccione el sexo-'
                ))
                ->add('role', null, array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Clave de acceso',
                    ),
                    'required' => true,
                    'empty_value' => '-Seleccione el rol-'
                ))
                ->add('password', 'password', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Clave de acceso'
                    )
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DBOJ\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dboj_userbundle_user';
    }
}
