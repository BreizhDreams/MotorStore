<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvantageController extends AbstractController
{
    #[Route('/advantage', name: 'app_advantage')]
    public function index(): Response
    {
        return $this->render('advantage/index.html.twig', [
            'controller_name' => 'AdvantageController',
        ]);
    }
}
