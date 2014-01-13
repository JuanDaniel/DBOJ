<?php

namespace DBOJ\CompetitionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompetitionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('creationDate')
            ->add('startDate')
            ->add('duration')
            ->add('active')
            ->add('type')
            ->add('timeOut')
            ->add('timeFrozen')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DBOJ\CompetitionBundle\Entity\Competition'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dboj_competitionbundle_competition';
    }
}
