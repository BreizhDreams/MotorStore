<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderSuccessController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/order/success/{stripeSessionId}', name: 'orderSuccess')]
    public function index(Cart $cartVO ,$stripeSessionId, Request $request, NavbarService $navbarService): Response
    {
        $orderVO = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        if (!$orderVO || $orderVO->getUserVO() != $this->getUser()){
            return $this->redirectToRoute('homePage');
        }

        if (!$orderVO->isIsPaid()) {
            $cartVO->delete();
            $orderVO->setIsPaid(1);

            if($orderVO->getUserVO()->getFidelityCardVO()){
                $fidelityCardVO = $orderVO->getUserVO()->getFidelityCardVO();
                $totalOrder = $orderVO->getTotal();
                $totalPoints = $fidelityCardVO->getAmountOfPoints($totalOrder);
                $fidelityCardVO->addPoints($totalPoints);
            }

            $this->entityManager->flush();
        }

        $navbar = $navbarService->getFullNavbar($this->entityManager , $request);

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }

        return $this->render('order_success/success.html.twig', [
            'categoryVOs' => $navbar[0],
            'orderVO' => $orderVO,
            'formMenu' => $navbar[1]->createView(),
        ]);
    }
}
