<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
        ]);
    }

    #[Route('/product/{slug}', name: "voirProduit")]
    public function showProduct(EntityManagerInterface $entityManager, $slug): Response
    {
        
        $productVO = $entityManager->getRepository(Product::class)->findOneBySlug($slug);
        if(!$productVO){
            return $this->redirectToRoute('app_main');
        }

        return $this->render('product/showProduct.html.twig',[
            'productVO' => $productVO,
        ]);
    }

    #[Route('products', name: 'app_products')]
    public function showAllProducts(EntityManagerInterface $entityManager): Response
    {        
        $productVOs = $entityManager->getRepository(Product::class)->findAll();

        return $this->render('product/showAllProducts.html.twig',[
            'productVOs' => $productVOs
        ]);
    }
}
