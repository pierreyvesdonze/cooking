<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Entity\RecipeCategory;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'    => false,
                'required' => true,
                'attr'     => [
                    'placeholder' => 'Donnez un titre à votre recette'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label'    => false,
                'required' => true,
                'attr'     => [
                    'placeholder' => 'Décrivez votre recette en quelques mots'
                ]
            ])
            ->add('portions', TextType::class, [
                'label'    => false,
                'required' => true,
                'attr'     => [
                    'placeholder' => 'Combien de portions ?'
                ]
            ])
            ->add('timePrepa', TextType::class, [
                'label'    => false,
                'required' => true,
                'attr'     => [
                    'placeholder' => 'Temps de préparation'
                ]
            ])
            ->add('timeCooking', TextType::class, [
                'label'    => false,
                'required' => true,
                'attr'     => [
                    'placeholder' => 'Temps de cuisson'
                ]
            ])
            ->add('recipeIngredients', CollectionType::class, [
                'label'         => false,
                'mapped'        => false,
                'entry_type'    => RecipeIngredientType::class,
                'entry_options' => [
                    'label' => false
                ],
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('recipeSteps', CollectionType::class, [
                'label'         => false,
                'mapped'        => false,
                'entry_type'    => RecipeStepType::class,
                'entry_options' => [
                    'label' => false
                ],
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                
            ])
            ->add('image', FileType::class, [
                'label'    => 'Ajouter une image (conseillé)',
                'multiple' => false,
                'mapped'   => false,
                'required' => false,
                'attr'     => [
                    'class' => 'img-recipe',
                ],
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png'
                        ],
                    ])
                ],
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie',
                'class' => RecipeCategory::class,
                'choice_label' => 'title'
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Valider",
                'attr'  => [
                    'class' => "btn validate-btn"
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
