<?php


namespace App\Form;

use App\Entity\Company;
use App\Entity\Consigne;
use App\Entity\DeliveryLocation;
use App\Entity\LoadingLocations;
use App\Entity\Shipment;
use App\Entity\Transporteur;
use App\Entity\TypeLoading;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $baseInputClass = 'form-input block w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600';
        $baseSelectClass = 'form-select block w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600';

        $builder
            ->add('company', EntityType::class, [
                'label' => 'Entreprise',
                'class' => Company::class,
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez une entreprise',
                'attr' => [
                    'class' => $baseSelectClass,
                ],
            ])
            ->add('numberReference', IntegerType::class, [
                'label' => 'Numero de Reference',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entrer Numero de Reference',
                ],
            ])
            ->add('consigne', EntityType::class, [
                'label' => 'Destinataire',
                'class' => Consigne::class,
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez un destinataire',
                'attr' => [
                    'class' => $baseSelectClass,
                ],
            ])
            ->add('deliveryLocation', EntityType::class, [
                'label' => 'Lieu de Livraison',
                'class' => DeliveryLocation::class,
                'choice_label' => 'place',
                'placeholder' => 'Sélectionnez un lieu de livraison',
                'attr' => [
                    'class' => $baseSelectClass,
                ],
            ])
            ->add('loadingLocation', EntityType::class, [
                'label' => 'Lieu de Chargement',
                'class' => LoadingLocations::class,
                'choice_label' => 'place',
                'placeholder' => 'Sélectionnez un lieu de chargement',
                'attr' => [
                    'class' => $baseSelectClass,
                ],
            ])
            ->add('tractorPlate', TextType::class, [
                'label' => 'Plaque du Tracteur',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entrez la plaque du tracteur',
                ],
            ])
            ->add('trailerPlate', TextType::class, [
                'label' => 'Plaque de la Remorque',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entrez la plaque de la remorque',
                ],
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantité',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entrez la quantité',
                ],
            ])
            ->add('nombrePalette', IntegerType::class, [
                'label' => 'Nombre de Palette',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entrer Nombre de Palette',
                ],
            ])

            ->add('typeLoading', EntityType::class, [
                'label' => 'Type de chargement ',
                'class' => TypeLoading::class,
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez le type de chargement',
                'attr' => [
                    'class' => $baseSelectClass,
                ],
            ])
            ->add('tourNumber', IntegerType::class, [
                'label' => 'Numéro de Tour',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entrez le numéro de tour',
                ],
            ])
            ->add('transporteur', EntityType::class, [
                'label' => 'Transporteur',
                'class' => Transporteur::class,
                'choice_label' => 'name',
                'placeholder' => 'Entrez le Transporteur',
                'attr' => [
                    'class' => $baseInputClass,

                ],
            ])
            ->add('departureTime', TimeType::class, [
                'label' => 'Heure de Départ',
                'widget' => 'single_text',
                'input' => 'datetime', // Optionnel, pour s'assurer que l'entrée est un objet DateTime
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => "Sélectionnez l'heure de départ",
                ],
            ])
            ->add('arrivalTime', TimeType::class, [
                'label' => "Heure d'Arrivée",
                'widget' => 'single_text',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => "Sélectionnez l'heure d'arrivée",
                ],
            ])
            ->add('sealNumber', TextType::class, [
                'label' => 'Numéro de Scellé',
                'attr' => [
                    'class' => $baseInputClass,
                    'placeholder' => 'Entrez le numéro de scellé',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Shipment::class,
        ]);
    }
}
