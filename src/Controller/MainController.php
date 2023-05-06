<?php

namespace App\Controller;

use App\Entity\Header;
use App\Entity\Product;
use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/ ', name: 'homePage')]
    public function index(EntityManagerInterface $entityManager, NavbarService $navbarService, Request $request): Response
    {
        $productVOs = $entityManager->getRepository(Product::class)->findByIsBest(1);
        $headerVOs = $entityManager->getRepository(Header::class)->findAll();

        $navbar = $navbarService->getFullNavbar($entityManager , $request);

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }
        return $this->render('base.html.twig',[
            'categoryVOs' => $navbar[0],
            'productVOs' => $productVOs,
            'headerVOs' => $headerVOs,
            'formMenu' => $navbar[1]->createView(),
        ]);
    }

}

