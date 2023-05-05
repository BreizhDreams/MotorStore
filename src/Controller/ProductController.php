<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    /**
     *  Fonction qui renvoi le produit qui a été sélectionner par l'utilisateur
     *  Dans l'url on retrouve le slug
     */
    #[Route('/product/{slug}', name: "voirProduit")]
    public function showProduct(EntityManagerInterface $entityManager, $slug, NavbarService $navbarService, HttpFoundationRequest $request): Response
    {
        $navbar = $navbarService->getFullNavbar($entityManager , $request );

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }
        
        $productVO = $entityManager->getRepository(Product::class)->findOneBySlug($slug);
        if(!$productVO){
            return $this->redirectToRoute('app_main');
        }

        $productVOs = $entityManager->getRepository(Product::class)->findByIsBest(1);

        return $this->render('product/showProduct.html.twig',[
            'categoryVOs' => $navbar[0],
            'productVO' => $productVO,
            'productVOs' => $productVOs,
            'formMenu' => $navbar[1]->createView(),
        ]);
    }

    /**
     * Recherche tous les produits, si filtrage choisi par l'utilisateur alors recherche selon la requête de l'utilisateur. 
     */
    #[Route('products', name: 'app_products')]
    public function showAllProducts(EntityManagerInterface $entityManager, HttpFoundationRequest $request, NavbarService $navbarService): Response
    {        

        $navbar = $navbarService->getFullNavbar($entityManager , $request);

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        } else if($navbar[2]->isSubmitted() && $navbar[2]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        } else {
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }

    }
}
