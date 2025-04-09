<?php

namespace App\Form;

use App\Entity\Transporteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransporteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $baseInputClass = 'form-input block w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600';
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom Transporteur",
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => "Entre Transporteur"
                ]
            ])
            ->add('address', TextType::class, [
                'label' => "Adress Transporteur",
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => "Adress Transporteur"
                ]
            ])
            ->add('country', TextType::class, [
                'label' => "Pays Transporteur",
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => "Pays Transporteur"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transporteur::class,
        ]);
    }
}
