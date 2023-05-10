<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Product;
use App\Service\NavbarService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class CartController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/showCart', name: 'showCart')]
    public function index(Cart $cart, Request $request, NavbarService $navbarService)
    {
        $navbar = $navbarService->getFullNavbar($this->entityManager , $request);

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }
        
        return $this->render('cart/showCart.html.twig', [
            'categoryVOs' => $navbar[0],
            'cartVOs' => $cart->getFull(),
            'formMenu' => $navbar[1]->createView(),
        ]);
    }

    #[Route('cart/add/{id}', name: 'addToCart')]
    public function addToCart(Cart $cart, $id)
    {
        // Récupération du produit avec l'ID
        $productVO = $this->entityManager->getRepository(Product::class)->findOneById($id);
        // Récupération du panier
        $cartVO = $cart->getFull();

        foreach($cartVO as $product){
            // Pour chaque produit du panier on compare si il correspond au produit qu'on veut rajouter
            if($product['productVO'] == $productVO){
                $quantity = $product['quantity'];
                $limitationVOs = $productVO->getLimitationVOs();
                // Si correspond, récupération de la quantité du panier et de la limitation
                // Passage des dates de la limitation en Timestamp UNIX pour comparaison plus simple
                $date = new DateTime();
                $date = $date->getTimestamp();
    
                // On vérifie si le produit n'a pas plusieurs limitation d'achat en base (une actuelle et plusieurs précédente)
                foreach ($limitationVOs as $limitationVO){
                    $limitationStartDate = $limitationVO->getStartDate()->getTimestamp();
                    $limitationEndDate = $limitationVO->getEndDate()->getTimestamp();
    
                    // SI date du jour entre date début et fin et quantité atteinte, on redirige vers le panier sans ajouter. 
                    if(($limitationStartDate < $date) || ($limitationEndDate > $date)){
                        if($quantity >= $limitationVOs[0]->getLimitQuantity()){
                            return $this->redirectToRoute('showCart');
                        }
                    }
                }
            }
        }

        $cart->add($id);

        return $this->redirectToRoute('showCart');
    }

    #[Route('cart/remove/{id}', name: 'removeFromCart')]
    public function removeCart(Cart $cart, $id)
    {
        $cart->remove($id);

        return $this->redirectToRoute('showCart');
    }

    #[Route('cart/delete', name: 'deleteCart')]
    public function deleteCart(Cart $cart)
    {
        $cart->delete();
        return $this->redirectToRoute('showCart');
    }
}
