<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Nazwa'))
            ->add('date', DateType::class, array('label' => 'Data', 'widget' => 'single_text'))
            ->add('start', TimeType::class, array('label' => 'Start', 'widget' => 'single_text'))
            ->add('end', TimeType::class, array('label' => 'Koniec', 'widget' => 'single_text'))
            ->add('address', TextType::class, array('label' => 'Adres'))
            ->add('description', TextareaType::class, array('label' => 'Opis', 'attr' => array('class'=>'summernote')))
            ->add('save', SubmitType::class, array('label' => 'Zapisz', 'attr' => array('class' => 'float-right btn-secondary')));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_event';
    }


}
