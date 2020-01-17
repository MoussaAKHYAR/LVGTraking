<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ->add('email', EmailType::class, array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle',
            'attr' => [
                'placeholder' => "Saisir l'adresse email",
                'class' => 'form-control'
            ]))
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle',
            'attr' => [
                'placeholder' => "Saisir le nom d'utilisateur",
                'class' => 'form-control'
            ]))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array( 'attr' => [
                    'placeholder' => "Saisir le mot de passe",
                    'class' => 'form-control'
                ]),
                'second_options' => array( 'attr' => [
                    'placeholder' => "Confirmer le mot de passe",
                    'class' => 'form-control'
                ]),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
