<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
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
    public function showCategory(EntityManagerInterface $entityManager, $slug): Response
    {
        $categoryVO = $entityManager->getRepository(Category::class)->findOneBySlug($slug);
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();


        return $this->render('category/showCategory.html.twig',[
            'categoryVOs' => $categoryVOs,
            'categoryVO' => $categoryVO,
        ]);
    }

    
}
