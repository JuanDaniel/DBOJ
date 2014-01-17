<?php

namespace DBOJ\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CatalogType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
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
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $type = $this->type;

        if ($type) {
            $choices = array();
            $catalog = $this->manager->getRepository('CommonBundle:Catalog')->findOneByValue($type);
            $nomenclator = $this->manager->getRepository('CommonBundle:Nomenclator')->findByCatalog($catalog);

            foreach ($nomenclator as $value) {
                $choices[$value->getId()] = $value; #$value->getValor();
            }
            $resolver->setDefaults(array(
                'choices' => $choices,
                'type' => 'DBOJ\CommonBundle\Entity\Nomenclator'
            ));
        }
    }

    public static function Type($type, $extras = array()) {
        if ($type) {
            $choices = array();
            $manager = $GLOBALS['kernel']->getContainer()->get('doctrine')->getManager();
            $catalog = $manager->getRepository('CommonBundle:Catalog')->findOneByValue($type);

            return array_merge(
                    array(
                'class' => 'CommonBundle:Nomenclator',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) use ($catalog) {
            return $er->createQueryBuilder('n')
                            ->where('n.catalog = :catalog')
                            ->setParameter('catalog', $catalog->getId());
            ;
        },
                'required' => false
                    ), $extras
            );
        }
    }

    /**
     * @return string
     */
    public function getName() {
        return 'dboj_commonbundle_catalog';
    }

}
