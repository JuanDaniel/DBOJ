<?php

namespace DBOJ\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of EngineParametersType
 *
 * @author jdsantana
 */
class EngineParametersType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('host_db', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Dirección host de la DB'
                    )
                ))
                ->add('port_db', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Puerto de la DB'
                    )
                ))
                ->add('user_db', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Usuario de acceso a la DB'
                    )
                ))
                ->add('password_db', 'password', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Clave de acceso a la DB'
                    )
                ))
                ->add('user_xmpp', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Usuario en el servidor XMPP'
                    )
                ))
                ->add('password_xmpp', 'password', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Clave de acceso en el servidor XMPP'
                    )
                ))
        ;
    }
    
    public function getName() {
        return 'dboj_backend_parameters_engine';
    }
}
