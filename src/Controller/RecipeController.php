<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeCategoryRepository;
use App\Repository\RecipeRepository;
use App\Service\ImageManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recette')]
class RecipeController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    #[Route('s/', name: 'app_recipe_index', methods: ['GET'])]
    public function index(
        RecipeRepository $recipeRepository,
        RecipeCategoryRepository $recipeCategoryRepository
        ): Response
    {
        $categories = $recipeCategoryRepository->findAll();

        return $this->render('recipe/index.html.twig', [
            'recipies' => $recipeRepository->findAll(),
            'categories' => $categories
        ]);
    }

    #[Route('/ajouter', name: 'app_recipe_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        ImageManager $imageManager
    ): Response {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $recipe = new Recipe();
        $recipe->setUser($this->getUser());
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipe->setTitle($form->get('title')->getData());
            $image = $form->get('image')->getData();

            if ($image) {
                $imageFileName = $imageManager->upload($image);
                $imageManager->resize($imageFileName);
                $recipe->setImage($imageFileName);
            }

            foreach ($form->get('recipeStep')->getdata() as $recipeStep) {
                $recipe->addRecipeStep($recipeStep);
                $this->em->persist($recipeStep);
            }

            foreach ($form->get('recipeIngredient')->getdata() as $recipeIngredient) {
                $recipe->addRecipeIngredient($recipeIngredient);
                $this->em->persist($recipeIngredient);
            }

            $this->em->persist($recipe);
            $this->em->flush();

            return $this->redirectToRoute('app_recipe_show', [
                'id' => $recipe->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recipe/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_recipe_show', methods: ['GET'])]
    public function show(Recipe $recipe): Response
    {
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    #[Route('/{id}/editer', name: 'app_recipe_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Recipe $recipe,
        ImageManager $imageManager
    ): Response {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();

            if ($image) {
                $imageFileName = $imageManager->upload($image);
                $imageManager->resize($imageFileName);
                $recipe->setImage($imageFileName);
            }

            $this->em->flush();

            return $this->redirectToRoute('app_recipe_show', [
                'id' => $recipe->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/supprimer/{id}', name: 'app_recipe_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Recipe $recipe,
        RecipeRepository $recipeRepository,
        ImageManager $imageManager
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $recipe->getId(), $request->request->get('_token'))) {
            $imageManager->deleteImage($recipe->getImage());
            $recipeRepository->remove($recipe, true);
        }

        return $this->redirectToRoute('app_recipe_index', [], Response::HTTP_SEE_OTHER);
    }
}
