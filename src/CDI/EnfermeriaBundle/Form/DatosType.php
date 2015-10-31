<?php

namespace CDI\EnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DatosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('nombres', 'text', array(
                    'label' => 'Nombres',
                    'required' => true,
                    'attr' => array('class' => 'form-control', 'placeholder' => 'Nombres'),
                    'label_attr' => array('class' => 'col-lg-2 control-label')
                ))
                ->add('apellidos', 'text', array(
                    'label' => 'Apellidos',
                    'required' => true,
                    'attr' => array('class' => 'form-control', 'placeholder' => 'Apellidos'),
                    'label_attr' => array('class' => 'col-lg-2 control-label')
                ))
                ->add('cedula', 'integer', array(
                    'label' => 'Cedula',
                    'required' => true,
                    'attr' => array('class' => 'form-control', 'placeholder' => 'Cédula de Identidad'),
                    'label_attr' => array('class' => 'col-lg-2 control-label')
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CDI\EnfermeriaBundle\Entity\Datos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cdi_enfermeriabundle_datos';
    }
}
