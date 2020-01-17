<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle',
            'attr' => [
                'placeholder' => "Saisir le nom d'utilisateur",
                'class' => 'form-control'
            ]))
            ->add('email', EmailType::class, array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle',
            'attr' => [
                'placeholder' => "Saisir l'adresse email",
                'class' => 'form-control'
            ]))
            ->add('nom', TextType::class,[
                'attr' => [
                    'placeholder' => "Saisir le nom",
                    'class' => 'form-control'
                ]
            ])
            ->add('prenom', TextType::class,[
                'attr' => [
                    'placeholder' => "Saisir le prenom",
                    'class' => 'form-control'
                ]
            ])
            ->add('telephone', TextType::class,[
                'attr' => [
                    'placeholder' => "Saisir le numéro de telephone",
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
