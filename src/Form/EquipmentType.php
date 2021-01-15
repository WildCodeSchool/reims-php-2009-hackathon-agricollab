<?php

namespace App\Form;

use App\Entity\Equipment;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('registration', TextType::class, ['label' => "Immatriculation"])
            ->add('brand', TextType::class, ['label' => "Marque"])
            ->add('type', TextType::class, ['label' => "Catégorie"])
            ->add('model', TextType::class, ['label' => "Modèle"])
            ->add('registrationYear', DateTimeType::class, ['label' => "Année"])
            ->add('buyValue', IntegerType::class, ['label' => "Valeur d'achat"])
            ->add('lifetime', IntegerType::class, ['label' => "Durée de vie"])
            ->add('workTime', IntegerType::class, ['label' => "Heures de travail"])
            ->add('horsepower', IntegerType::class, ['label' => "Puissance du véhicule"])
            //->add('useCost', NumberType::class, ['label' => "Coût d'utilisation"])
            ->add('residualValue', IntegerType::class, ['label' => "Valeur résiduelle"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipment::class,
        ]);
    }
}
