<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/category/{slug}', name: "voirCategorie")]
    public function showCategory(Category $categoryVO): Response
    {
        return $this->render('category/showCategory.html.twig',[
            'categoryVO' => $categoryVO,
        ]);
    }

    
}
