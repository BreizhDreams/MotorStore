<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FidelityCardController extends AbstractController
{
    #[Route('/fidelity_card/show', name: 'voirProgFidelite')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();

        return $this->render('fidelity_card/showProgram.html.twig',[
            'categoryVOs' => $categoryVOs,
        ]);
    }
}
