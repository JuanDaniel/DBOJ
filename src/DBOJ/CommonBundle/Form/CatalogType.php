<?php

namespace DBOJ\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CatalogType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', 'text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Nombre del catálogo'
                )
            ))
            ->add('description', 'textarea', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Descripción del catálogo'
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
            'data_class' => 'DBOJ\CommonBundle\Entity\Catalog'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dboj_commonbundle_nomenclator';
    }
}
