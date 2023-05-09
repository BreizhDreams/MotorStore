<?php

namespace App\Controller;

use App\Entity\Contain;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/order/createSession/{reference}', name: 'createStripeSession')]
    public function index($reference)
    {
        $YOUR_DOMAIN = 'http://127.0.0.1:8000';
        $stripeProduct = [];
        
        // Récupération de l'objet Order par la référence de la commande
        $orderVO = $this->entityManager->getRepository(Order::class)->findOneByReference($reference);
        if (!$orderVO){
            return $this->redirectToRoute('showOrder');
        }
        $userVO = $this->getUser();

        if($orderVO->isHasDiscountCode() == true){
            $discountId = [
                'REDUC5' => 'Icm78S9R',
                'REDUC10' => 'kxJFddF8',
                'REDUC25' => 'Hl4XQORz',
                'REDUC50' => 'rTYkdVk3',
                'REDUC100' => '3w8ReaAq',
                'REDUC250' => 'TNYduKwW',
                'REDUC500' => 'aiheB1Ur',
            ];
            $advantageVO = $orderVO->getAdvantageVO();
            $containVO = $this->entityManager->getRepository(Contain::class)->findAdvantageInFidelityCard($userVO->getFidelityCardVO()->getId(), $advantageVO->getId());
            if($containVO[0]->getQuantity() > 1 ){
                $containVO[0]->setQuantity($containVO[0]->getQuantity() -1);
            }
            else{
                $containVO[0]->setQuantity(0);
            }
        }

        // Order Products
        foreach ($orderVO->getOrderDetails()->getValues() as $productVO) {
            $stripeProduct[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $productVO->getPrice(),
                    'product_data' => [
                        'name' => $productVO->getProduct(),
                    ]
                ],
                'quantity' => $productVO->getQuantity(),
            ];
        }
        
        // Order Transporter
        $stripeProduct[] = [
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => $orderVO->getTransporterPrice(),
                'product_data' => [
                    'name' => $orderVO->getTransporterName(),
                ]
            ],
            'quantity' => $productVO->getQuantity(),
        ];


        Stripe::setApiKey('sk_test_51MzQOeHI3g0w1ahIJET8RbOOlGGrEaPDGmqRvTqid7g9U6axCtYssKUMoRfqm0AzvNLn1VOAmi3kKFQOmYLahDoV00QiQ8veQQ');
        header('Content-Type: application/json');
        
        if($orderVO->isHasDiscountCode() == true){
            $checkout_session = Session::create([
                'customer_email' => $userVO->getEmail(),
                'payment_method_types' => ['card'],
                'line_items' => [
                    $stripeProduct
                ],
                'mode' => 'payment',
                'discounts' => [[
                    'coupon' => $discountId[$advantageVO->getReference()],
                  ]],
                'success_url' => $YOUR_DOMAIN . '/order/success/{CHECKOUT_SESSION_ID}',
                'cancel_url' => $YOUR_DOMAIN . '/order/error/{CHECKOUT_SESSION_ID}',
            ]);
        }else{
            $checkout_session = Session::create([
                'customer_email' => $userVO->getEmail(),
                'payment_method_types' => ['card'],
                'line_items' => [
                    $stripeProduct
                ],
                'mode' => 'payment',
                'success_url' => $YOUR_DOMAIN . '/order/success/{CHECKOUT_SESSION_ID}',
                'cancel_url' => $YOUR_DOMAIN . '/order/error/{CHECKOUT_SESSION_ID}',
            ]);
        }

        
        $orderVO->setStripeSessionId($checkout_session->id);
        $this->entityManager->flush();

        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);
        exit;

    }
}
