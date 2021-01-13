<?php

namespace App\Form;

use App\Entity\Equipment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('registration')
            ->add('brand')
            ->add('type')
            ->add('model')
            ->add('registrationYear')
            ->add('buyValue')
            ->add('lifetime')
            ->add('workTime')
            ->add('horsepower')
            ->add('useCost')
            ->add('residualValue')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipment::class,
        ]);
    }
}
