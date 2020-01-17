<?php

namespace App\Form;

use App\Entity\PointDinteret;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointDinteretType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lieu',TextType::class, array('label' => 'Lieu',
            'attr' => [
                'placeholder' => "Saisir le lieu",
                'class' => 'form-control'
            ]))
            ->add('latitude', NumberType::class, array('label' => 'Latitude',
            'attr' => [
                'placeholder' => "Saisir la Latitude",
                'class' => 'form-control'
            ]))
            ->add('longitude', NumberType::class, array('label' => 'Longitude',
            'attr' => [
                'placeholder' => "Saisir la longitude",
                'class' => 'form-control'
            ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PointDinteret::class,
        ]);
    }
}
