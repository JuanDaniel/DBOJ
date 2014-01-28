<?php

namespace DBOJ\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of ComunicationParametersType
 *
 * @author jdsantana
 */
class ComunicationParametersType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('host_xmpp', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Dirección host del servidor XMPP'
                    )
                ))
                ->add('port_xmpp', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Puerto del servidor XMPP'
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
        return 'dboj_backend_parameters_comunication';
    }
}
