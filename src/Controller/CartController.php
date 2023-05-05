<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(Cart $cart, EntityManagerInterface $entityManager, Request $request, NavbarService $navbarService)
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
        
        return $this->render('cart/showCart.html.twig', [
            'categoryVOs' => $navbar[0],
            'cartVOs' => $cart->getFull(),
            'formMenu' => $navbar[1]->createView(),
        ]);
    }

    #[Route('cart/add/{id}', name: 'cart_add')]
    public function addToCart(Cart $cart, $id)
    {
        $cart->add($id);

        return $this->redirectToRoute('cart');
    }

    #[Route('cart/remove/{id}', name: 'cart_remove')]
    public function removeCart(Cart $cart, $id)
    {
        $cart->remove($id);

        return $this->redirectToRoute('cart');
    }

    #[Route('cart/delete', name: 'cart_delete')]
    public function deleteCart(Cart $cart)
    {
        $cart->delete();
        return $this->redirectToRoute('cart');
    }
}
