<?php

namespace App\Form;

use App\Entity\Conducteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ConducteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, array('label' => 'Nom',
            'attr' => [
                'placeholder' => "Saisir le Nom",
                'class' => 'form-control'
            ]))
            ->add('prenom', null, array('label' => 'Prenom',
            'attr' => [
                'placeholder' => "Saisir le Prenom",
                'class' => 'form-control'
            ]))
            ->add('DateNaissance', DateType::class, array('label' => 'Date de naissance', 'widget' => 'single_text',
            'attr' => [
                'placeholder' => "Saisir la date de naissance",
                'class' => 'form-control',
            ]))
            ->add('tel', null, array('label' => 'Telephone',
            'attr' => [
                'placeholder' => "Saisir le numéro de telephone",
                'class' => 'form-control'
            ]))
            ->add('adresse', null, array('label' => 'Adresse',
            'attr' => [
                'placeholder' => "Saisir l'adresse",
                'class' => 'form-control'
            ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Conducteur::class,
        ]);
    }
}
