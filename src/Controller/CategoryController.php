<?php

namespace App\Controller;

use App\Entity\Category;
use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    #[Route('/category/{slug}', name: "showCategory")]
    public function showCategory(EntityManagerInterface $entityManager, $slug, Request $request, NavbarService $navbarService): Response
    {
        $categoryVO = $entityManager->getRepository(Category::class)->findOneBySlug($slug);

        $navbar = $navbarService->getFullNavbar($entityManager , $request );

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }
        
        return $this->render('category/showCategory.html.twig',[
            'categoryVOs' => $navbar[0],
            'categoryVO' => $categoryVO,
            'formMenu' => $navbar[1]->createView(),
        ]);
    }

    
}
