<?php

namespace DBOJ\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of ArticleType
 *
 * @author JuanLuis
 */
class ArticleType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Título del artículo'
                    )
                ))
                ->add('content', 'textarea', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Contenido del artículo'
                    )
                ))
                ->add('tags', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Etiquetas'
                    )
                ))
                ->add('publicationDate','date', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Fecha de publicación del artículo'
                ),
                'widget'=>'single_text'
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'DBOJ\NewsBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'dboj_newsbundle_article';
    }

}

?>
