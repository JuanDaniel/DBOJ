<?php

namespace DBOJ\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of CommentType
 *
 * @author JuanLuis
 */
class CommentType extends AbstractType{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', 'text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Contenido del comentario'
                )
            ))  
                
                /*DUDA EN ESTO AKI*/
            ->add('articulo', null, array(
                'attr' => array(
                    'class' => 'form-control',
                    'required' => true
                ),
                'empty_value' => '-Seleccione un articulo-'
            ))
           ->add('usuario', null, array(
                'attr' => array(
                    'class' => 'form-control',
                    'required' => true
                ),
                'empty_value' => '-Seleccione un usuario-'
            ))            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DBOJ\NewsBundle\Entity\Comment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dboj_newsbundle_comment';
    }
}

?>
