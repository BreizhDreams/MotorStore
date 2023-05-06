<?php

namespace App\Controller;

use App\Entity\SubCategory;
use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubCategoryController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/sub/category/{slug}', name: "showSubCategory")]
    public function showSubCategory($slug, NavbarService $navbarService, Request $request): Response
    {

        $subCategoryVO = $this->entityManager->getRepository(SubCategory::class)->findOneBySlug($slug);

        $navbar = $navbarService->getFullNavbar($this->entityManager , $request );

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }

        return $this->render('sub_category/showSubCategory.html.twig',[
            'categoryVOs' => $navbar[0],
            'subCategoryVO' => $subCategoryVO,
            'formMenu' => $navbar[1]->createView(),
        ]);
    }
}
