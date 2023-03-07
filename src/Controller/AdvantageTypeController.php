<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvantageTypeController extends AbstractController
{
    #[Route('/advantage/type', name: 'app_advantage_type')]
    public function index(): Response
    {
        return $this->render('advantage_type/index.html.twig', [
            'controller_name' => 'AdvantageTypeController',
        ]);
    }
}
