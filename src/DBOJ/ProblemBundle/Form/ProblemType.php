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
            ->add('title')
            ->add('description')
            ->add('creationDate')
            ->add('active')
            ->add('fileSql')
            ->add('solution')
            ->add('nameDatabase')
            ->add('time')
            ->add('memory')
            ->add('competition')
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
