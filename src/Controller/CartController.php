<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(Cart $cart, EntityManagerInterface $entityManager)
    {
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();

        return $this->render('cart/showCart.html.twig', [
            'categoryVOs' => $categoryVOs,
            'cartVOs' => $cart->getFull()
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
