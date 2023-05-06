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
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     *  Fonction qui renvoi le produit qui a été sélectionner par l'utilisateur
     *  Dans l'url on retrouve le slug
     */
    #[Route('/product/{slug}', name: "showProduct")]
    public function showProduct($slug, NavbarService $navbarService, HttpFoundationRequest $request): Response
    {
        $navbar = $navbarService->getFullNavbar($this->entityManager , $request );

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }
        
        $productVO = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);
        if(!$productVO){
            return $this->redirectToRoute('homePage');
        }

        $productVOs = $this->entityManager->getRepository(Product::class)->findByIsBest(1);

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
    #[Route('products', name: 'showFilteredProducts')]
    public function showAllProducts(HttpFoundationRequest $request, NavbarService $navbarService): Response
    {        

        $navbar = $navbarService->getFullNavbar($this->entityManager , $request);

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
