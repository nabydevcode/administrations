<?php

namespace App\Form;

use App\Entity\Consigne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsigneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $baseInputClass = 'form-input block w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600';
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom  destinateur ',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entre le nom destinateur'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Adress du destinateur',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entre Adress destinateur'
                ]
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays du destinateur',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entre Pays destinateur'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consigne::class,
        ]);
    }
}
