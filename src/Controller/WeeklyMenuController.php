<?php

namespace App\Controller;

use App\Entity\WeeklyMenu;
use App\Form\WeeklyMenuType;
use App\Repository\WeeklyMenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/weekly/menu')]
class WeeklyMenuController extends AbstractController
{
    #[Route('/', name: 'app_weekly_menu_index', methods: ['GET'])]
    public function index(WeeklyMenuRepository $weeklyMenuRepository): Response
    {
        return $this->render('weekly_menu/index.html.twig', [
            'weekly_menus' => $weeklyMenuRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_weekly_menu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, WeeklyMenuRepository $weeklyMenuRepository): Response
    {
        $weeklyMenu = new WeeklyMenu();
        $form = $this->createForm(WeeklyMenuType::class, $weeklyMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weeklyMenuRepository->save($weeklyMenu, true);

            return $this->redirectToRoute('app_weekly_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('weekly_menu/new.html.twig', [
            'weekly_menu' => $weeklyMenu,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_weekly_menu_show', methods: ['GET'])]
    public function show(WeeklyMenu $weeklyMenu): Response
    {
        return $this->render('weekly_menu/show.html.twig', [
            'weekly_menu' => $weeklyMenu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_weekly_menu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WeeklyMenu $weeklyMenu, WeeklyMenuRepository $weeklyMenuRepository): Response
    {
        $form = $this->createForm(WeeklyMenuType::class, $weeklyMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weeklyMenuRepository->save($weeklyMenu, true);

            return $this->redirectToRoute('app_weekly_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('weekly_menu/edit.html.twig', [
            'weekly_menu' => $weeklyMenu,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_weekly_menu_delete', methods: ['POST'])]
    public function delete(Request $request, WeeklyMenu $weeklyMenu, WeeklyMenuRepository $weeklyMenuRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$weeklyMenu->getId(), $request->request->get('_token'))) {
            $weeklyMenuRepository->remove($weeklyMenu, true);
        }

        return $this->redirectToRoute('app_weekly_menu_index', [], Response::HTTP_SEE_OTHER);
    }
}
