<?php

namespace App\Form;

use App\Entity\WeeklyMenu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeeklyMenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['placeholder' => 'Titre du menu']
            ])
            ->add('breakfast', TextType::class, [
                'attr' => ['placeholder' => 'Petit déjeuner (optionnel)']
            ])
            ->add('firstSnack', TextType::class, [
                'attr' => ['placeholder' => 'Collation matinale (optionnel)']
            ])
            ->add('lunch', TextType::class, [
                'attr' => ['placeholder' => 'Déjeuner (optionnel)']
            ])
            ->add('secondSnack', TextType::class, [
                'attr' => ['placeholder' => "Collation d'après midi (optionnel)"]
            ])
            ->add('dinner', TextType::class, [
                'attr' => ['placeholder' => 'Diner (optionnel)']
            ])
            ->add('submit', SubmitType::class, [
                'label' => "M'enregistrer",
                'attr' => [
                    'class' => "btn custom-btn"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WeeklyMenu::class,
        ]);
    }
}
