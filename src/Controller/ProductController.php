<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Category;
use App\Entity\Product;
use App\Form\SearchType;
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
    public function showProduct(EntityManagerInterface $entityManager, $slug): Response
    {
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();
        $productVO = $entityManager->getRepository(Product::class)->findOneBySlug($slug);
        if(!$productVO){
            return $this->redirectToRoute('app_main');
        }

        return $this->render('product/showProduct.html.twig',[
            'categoryVOs' => $categoryVOs,
            'productVO' => $productVO,
        ]);
    }

    /**
     * Recherche tous les produits, si filtrage choisi par l'utilisateur alors recherche selon la requête de l'utilisateur. 
     */
    #[Route('products', name: 'app_products')]
    public function showAllProducts(EntityManagerInterface $entityManager, HttpFoundationRequest $request): Response
    {        
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $productVOs = $entityManager->getRepository(Product::class)->findWithSearch($search);
        }
        else{
            $productVOs = $entityManager->getRepository(Product::class)->findAll();
        }
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();

        return $this->render('product/showAllProducts.html.twig',[
            'categoryVOs' => $categoryVOs,
            'productVOs' => $productVOs,
            'form' => $form->createView(),
        ]);
    }
}
