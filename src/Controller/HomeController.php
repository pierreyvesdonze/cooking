<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
           
        ]);
    }

    #[Route('/test', name: 'test')]
    public function test()
    {
        $numbers = [0,5,19];

        dd(max($numbers));

        return $numbers;
    }
}
