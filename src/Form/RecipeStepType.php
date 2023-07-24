<?php

namespace App\Form;

use App\Entity\RecipeStep;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeStepType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextareaType::class, [
            'label'    => false,
            'required' => true,
            'attr'     => [
                'class'       => '',
                'placeholder' => "Décrivez cette étape"
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecipeStep::class,
        ]);
    }
}