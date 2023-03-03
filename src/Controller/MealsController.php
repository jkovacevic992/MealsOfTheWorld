<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MealsController extends AbstractController
{
    #[Route('/meals', name: 'app_meals')]
    public function index(Request $request): Response
    {
        $test = 1;
        return $this->render('meals/index.html.twig', [
            'controller_name' => 'MealsController',
        ]);
    }
}
