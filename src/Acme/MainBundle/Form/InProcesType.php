<?php

namespace Acme\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InProcesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('projectName')
            ->add('subject')
            ->add('fromWho')
            ->add('html')
            ->add('toWho')
            ->add('errors')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\MainBundle\Entity\InProces'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_mainbundle_inproces';
    }
}
