<?php

namespace App\Form;

use App\Entity\TypeLoading;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeLoadingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $baseInputClass = 'form-input block w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600';
        $builder
            ->add('name', TextType::class, [
                'label' => 'Type de chargement',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entre type de chargement'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeLoading::class,
        ]);
    }
}
