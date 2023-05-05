<?php

namespace App\Controller;

use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FidelityCardController extends AbstractController
{
    #[Route('/fidelity_card/show', name: 'voirProgFidelite')]
    public function index(EntityManagerInterface $entityManager, Request $request, NavbarService $navbarService): Response
    {
        $navbar = $navbarService->getFullNavbar($entityManager , $request);

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }
        return $this->render('fidelity_card/showProgram.html.twig',[
            'categoryVOs' => $navbar[0],
            'formMenu' => $navbar[1]->createView(),
        ]);
    }
}
