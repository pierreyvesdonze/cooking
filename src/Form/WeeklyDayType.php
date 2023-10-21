<?php

namespace App\Form;

use App\Entity\WeeklyDay;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeeklyDayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('day', TextType::class, [
                'attr' => ['placeholder' => 'Jour de la semaine'],
                'label' => false
            ])
            ->add('breakfast', TextType::class, [
                'attr' => ['placeholder' => 'Petit déjeuner (optionnel)'],
                'label' => false
            ])
            ->add('lunch', TextType::class, [
                'attr' => ['placeholder' => 'Déjeuner (optionnel)'],
                'label' => false
            ])
            ->add('dinner', TextType::class, [
                'attr' => ['placeholder' => 'Diner (optionnel)'],
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WeeklyDay::class,
        ]);
    }
}
