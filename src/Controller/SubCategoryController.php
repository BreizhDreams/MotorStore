<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\SubCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubCategoryController extends AbstractController
{
    #[Route('/sub/category', name: 'app_sub_category')]
    public function index(): Response
    {
        return $this->render('sub_category/index.html.twig', [
            'controller_name' => 'SubCategoryController',
        ]);
    }

    #[Route('/sub/category/{slug}', name: "voirSousCategorie")]
    public function showSubCategory(EntityManagerInterface $entityManager, $slug): Response
    {

        $subCategoryVO = $entityManager->getRepository(SubCategory::class)->findOneBySlug($slug);
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();

        return $this->render('sub_category/showSubCategory.html.twig',[
            'categoryVOs' => $categoryVOs,
            'subCategoryVO' => $subCategoryVO,
        ]);
    }
}
