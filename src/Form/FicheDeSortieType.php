<?php

namespace App\Form;

use App\Entity\FicheDeSortie;
use App\Entity\PointDinteret;
use App\Entity\Vehicule;
use App\Entity\Conducteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheDeSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lieuDepart',TextType::class, ['label'=> 'Lieu de départ'])
            ->add('destination',TextType::class)
            ->add('nombreLitre', IntegerType::class, ['label'=> 'Nombre de litre'])
            ->add('latitudedestination', NumberType::class, ['label'=> 'Latitude de destination'])
            ->add('longitudeDestination', NumberType::class,  ['label'=> 'Longitude de destination'])
            ->add('nombrePoint', IntegerType::class,  ['label'=> 'Nombre de point'])
            ->add('pointDinteret', EntityType::class, [
                'class' => PointDinteret::class,
                'choice_label' => 'lieu',
                'label' => 'Point d\'intéret',
            ])
            ->add('vehicule', EntityType::class, [
                'class' => Vehicule::class,
                'choice_label' => 'nom',
            ])
            ->add('conducteur', EntityType::class, [
                'class' => Conducteur::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FicheDeSortie::class,
        ]);
    }
}
