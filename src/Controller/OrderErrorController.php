<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderErrorController extends AbstractController
{
    #[Route('/order/error/{stripeSessionId}', name: 'app_order_error')]
    public function index(EntityManagerInterface $entityManager, $stripeSessionId): Response
    {

        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();
        $orderVO = $entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        if (!$orderVO || $orderVO->getUserVO() != $this->getUser()){
            return $this->redirectToRoute('app_main');
        }


        return $this->render('order_error/index.html.twig', [
            'categoryVOs' => $categoryVOs,
            'orderVO' => $orderVO,
        ]);
    }
}
