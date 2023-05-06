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
