<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
    
    #[Route("/product/new", name:"newprodut")]
    #[Route("/product/{id}/edit", name:"updateproduct")]
   
  public function GestionProprietaires(Product $productVO = null,
  Request $request, 
  EntityManagerInterface $manager)
  {
      
      if(!$productVO)
      {$productVO = new Product();}
      

      $form = $this->createForm(ProductType::class,$productVO);

      $form->handleRequest($request);

      if(($form->isSubmitted() && $form->isValid()))
      {
          
          $manager->persist($productVO);
          
          $manager->flush();

          return $this->redirectToRoute('retour');
      }

      return $this->render('product/manageProduct.html.twig', [
          'form' => $form->createView(),
          'editmode' => $productVO->getId() !== null
      ]);
  }
}
