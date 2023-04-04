<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(SessionInterface $session, ProductRepository $productRepository, EntityManagerInterface $entityManager): Response
    {
        $cart = $session->get('cart', []);

        $cartVOs = [];

        foreach($cart as $id => $quantity){
            $productVO = $productRepository->find($id);
            $cartVOs[] = [
                'product' => $productVO,
                'quantity' => $quantity,
            ];
        }
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();


        return $this->render('cart/showCart.html.twig',[
            'cartVOs' => $cartVOs,
            'categoryVOs' => $categoryVOs
        ]);
    }

    #[Route('cart/add/{id}', name: 'cart_add')]
    public function addToCart(Product $productVO, SessionInterface $session)
    {
        // Récupération du panier ou à défaut un panier vide ([])
        $cart = $session->get('cart', [] );
        $id = $productVO->getId();
        if(empty($cart[$productVO->getId()])){
            $cart[$id] = 1;
        }
        else{
            $cart[$id]++;
        }
        $session->set('cart', $cart);

        return $this->redirectToRoute('cart');
    }

    #[Route('cart/remove/{id}', name: 'cart_remove')]
    public function removeProduct(Product $productVO, $id, SessionInterface $session)
    {
        // Récupération du panier ou à défaut un panier vide ([])
        $cart = $session->get('cart', [] );
        $id = $productVO->getId();

        if(!empty($cart[$productVO->getId()])){
            if($cart[$id] > 1){
                $cart[$id]--;
            }else{
                unset($cart[$id]);
            }
        }
        $session->set('cart', $cart);

        return $this->redirectToRoute('cart');
    }

    #[Route('cart/delete/{id}', name: 'cart_delete')]
    public function deleteProduct(Product $productVO, $id, SessionInterface $session)
    {
        // Récupération du panier ou à défaut un panier vide ([])
        $cart = $session->get('cart', [] );
        $id = $productVO->getId();

        if(!empty($cart[$productVO->getId()])){
            unset($cart[$id]);
        }
        $session->set('cart', $cart);

        return $this->redirectToRoute('cart');
    }

    #[Route('cart/delete', name: 'cart_delete_all')]
    public function deleteAllCart( SessionInterface $session)
    {
        $session->remove('cart');
        return $this->redirectToRoute('cart');
    }
}
