<?php

namespace App\Form;

use App\Entity\LoadingLocation;
use App\Entity\LoadingLocations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoadingLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $baseInputClass = 'form-input block w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600';
        $builder
            ->add('place', TextType::class, [
                'label' => 'Lieu de chargement',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entrer lieu et adresse de chargement',
                ],
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays de chargement',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entrer le pays de chargment',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LoadingLocations::class,
        ]);
    }
}
