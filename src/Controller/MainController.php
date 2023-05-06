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
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/ ', name: 'homePage')]
    public function index(NavbarService $navbarService, Request $request): Response
    {
        $productVOs = $this->entityManager->getRepository(Product::class)->findByIsBest(1);
        $headerVOs = $this->entityManager->getRepository(Header::class)->findAll();

        $navbar = $navbarService->getFullNavbar($this->entityManager , $request);

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

