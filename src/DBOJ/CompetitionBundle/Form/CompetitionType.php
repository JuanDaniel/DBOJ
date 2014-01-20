<?php

namespace DBOJ\CompetitionBundle\Form;

use Doctrine\ORM\EntityRepository;
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
            ->add('name','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Nombre de la competencia'
                )
            ))
            ->add('description','textarea', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Descripción de la competencia'
                )
            ))
            ->add('startDate','date', array(
                'attr' => array(
                    'class' => 'form-control datepicker',
                    'placeholder' => 'Fecha de inicio de la competencia',
                    'autocomplete'=> 'off',
                ),
                'data' => new \DateTime('now'),
                'widget'=>'single_text'
            ))
            ->add('duration','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Duración de la competencia'
                )
            ))
            ->add('state', 'entity', array(
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'empty_value' => 'Seleccione el estado de la competencia',
                    'class' => 'DBOJ\CommonBundle\Entity\Nomenclator',
                    'query_builder' => function(EntityRepository $er){
                        return $er->createQueryBuilder('n')
                                ->join('n.catalog', 'c')
                                ->where('c.value = :catalog')
                                ->setParameter('catalog', 'EstadoCompetencia');
                    }
                ))
            ->add('type','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Tipo de competencia'
                )
            ))
            ->add('timeOut','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Tiempo muerto'
                )
            ))
            ->add('timeFrozen','text', array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Tiempo congelado'
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
