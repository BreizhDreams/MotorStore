<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FidelityCardController extends AbstractController
{
    #[Route('/fidelity/card', name: 'app_fidelity_card')]
    public function index(): Response
    {
        return $this->render('fidelity_card/index.html.twig', [
            'controller_name' => 'FidelityCardController',
        ]);
    }
}
