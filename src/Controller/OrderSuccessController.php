<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Category;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderSuccessController extends AbstractController
{
    #[Route('/order/success/{stripeSessionId}', name: 'app_order_success')]
    public function index(EntityManagerInterface $entityManager,Cart $cartVO ,$stripeSessionId): Response
    {
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();
        $orderVO = $entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        if (!$orderVO || $orderVO->getUserVO() != $this->getUser()){
            return $this->redirectToRoute('app_main');
        }

        if (!$orderVO->isIsPaid()) {
            $cartVO->delete();
            $orderVO->setIsPaid(1);
            $entityManager->flush();
        }

        return $this->render('order_success/success.html.twig', [
            'categoryVOs' =>  $categoryVOs,
            'orderVO' => $orderVO
        ]);
    }
}
