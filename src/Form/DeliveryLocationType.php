<?php

namespace App\Form;

use App\Entity\DeliveryLocation;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeliveryLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $baseInputClass = 'form-input block w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600';
        $builder
            ->add('place', TextType::class, [
                'label' => 'Lieu de livraison',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entrer lieu et adresse de livraison',
                ],
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays de livraison',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entrer le pays de livraison',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DeliveryLocation::class,
        ]);
    }
}
