<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Header;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/ ', name: 'app_main')]
    public function index(EntityManagerInterface $entityManager, HttpFoundationRequest $request): Response
    {
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();
/*
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $productVOs = $entityManager->getRepository(Product::class)->findWithSearch($search);
        }
        else{
            $productVOs = $entityManager->getRepository(Product::class)->findAll();
        }
        */
        $productVOs = $entityManager->getRepository(Product::class)->findByIsBest(1);
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();
        $headerVOs = $entityManager->getRepository(Header::class)->findAll();
        return $this->render('base.html.twig',[
            'categoryVOs' => $categoryVOs,
            'productVOs' => $productVOs,
            'headerVOs' => $headerVOs,
            /*
            'productVOs' => $productVOs,
            'form' => $form->createView(),  */
        ]);
    }
}
