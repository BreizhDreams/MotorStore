<?php

namespace App\Controller;

use App\Entity\Order;
use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderErrorController extends AbstractController
{
    #[Route('/order/error/{stripeSessionId}', name: 'orderError')]
    public function index(EntityManagerInterface $entityManager, $stripeSessionId, Request $request, NavbarService $navbarService): Response
    {
        $orderVO = $entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        if (!$orderVO || $orderVO->getUserVO() != $this->getUser()){
            return $this->redirectToRoute('homePage');
        }

        $navbar = $navbarService->getFullNavbar($entityManager , $request);

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }

        return $this->render('order_error/error.html.twig', [
            'categoryVOs' => $navbar[0],
            'orderVO' => $orderVO,
            'formMenu' => $navbar[1]->createView(),
        ]);
    }
}
