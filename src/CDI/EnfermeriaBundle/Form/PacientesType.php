<?php

namespace CDI\EnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PacientesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('datos', new DatosType(), array('label' => ' '))
                ->add('genero', 'choice', array(
                    'choices' => array(
                        'femenino' => 'Femenino',
                        'masculino' => 'Masculino'),
                    'label' => 'Género',
                    'empty_value' => 'Seleccione',
                    'attr' => array('class' => 'form-control'),
                    'label_attr' => array('class' => 'col-lg-2 control-label')
                ))
                
                ->add('fechaNacimiento', 'birthday', array(
                    
                    'label' => 'Fecha de Nacimiento',
                    'label_attr' => array('class' => 'col-lg-2 control-label'),
                    'attr' => array('class' => 'form-control'),
                    'format' => 'dd-MM-yyyy'))
                
                ->add('procedencia', 'choice', array(
                    'choices' => array(
                        'interno' => 'Interno',
                        'externo' => 'Externo'),
                    'label' => 'Procedencia del Paciente',
                    'empty_value' => 'Seleccione',
                    'attr' => array('class' => 'form-control'),
                    'label_attr' => array('class' => 'col-lg-2 control-label')
                ))
                ->add('tipo', 'choice', array('choices' => array(
                        'Estudiante' => 'Estudiante',
                        'Administrativo' => 'Administrativo',
                        'Obrero' => 'Obrero',
                        'Docente' => 'Docente'),
                    'label' => 'Tipo de Paciente',
                    'empty_value' => 'Seleccione',
                    'attr' => array('class' => 'form-control'),
                    'label_attr' => array('class' => 'col-lg-2 control-label')))
                ->add('pfg', null, array(
                    'label' => 'Programa de Formación de Grado',
                    'empty_value' => 'Seleccione',
                    'attr' => array('class' => 'form-control'),
                    'label_attr' => array('class' => 'col-lg-2 control-label')))


        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'CDI\EnfermeriaBundle\Entity\Pacientes'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'cdi_enfermeriabundle_pacientes';
    }

}
