<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Category;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Form\OrderType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'order')]
    public function index(EntityManagerInterface $entityManager, Cart $cartVO, Request $request): Response
    {
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();

        if (!$this->getUser()->getAddressVOs()->getValues()) {
            return $this->redirectToRoute('addAddress');
        }

        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);

        return $this->render('order/showOrder.html.twig', [
            'categoryVOs' => $categoryVOs,
            'form' => $form->createView(),
            'cartVO' => $cartVO->getFull()
        ]);
    }

    #[Route('/order/recap', name: 'order_recap')]
    public function add(EntityManagerInterface $entityManager, Cart $cartVO, Request $request): Response
    {
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();

        if (!$this->getUser()->getAddressVOs()->getValues()) {
            return $this->redirectToRoute('addAddress');
        }

        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new DateTime();
            $transporterVO = $form->get('Transporter')->getData();

            $addressVO = $form->get('Adresses')->getData();
            $addressVO_content = $addressVO->getFirstName() . ' ' . $addressVO->getLastName();
            $addressVO_content .= '<br/>' . $addressVO->getPhone();
            if ($addressVO->getCompany()) {
                $addressVO_content .= '<br/>' . $addressVO->getCompany();
            }
            $addressVO_content .= '<br/>' . $addressVO->getAddress();
            $addressVO_content .= '<br/>' . $addressVO->getPostalCode() . ' ' . $addressVO->getCity();
            $addressVO_content .= '<br/>' . $addressVO->getCountry();

            // Créer la commande avec les données du transporteur / Utilisateur / Adresse
            $orderVO = new Order();
            $reference = $date->format('dmY').'_'.uniqid();
            $orderVO->setReference($reference);
            $orderVO->setUserVO($this->getUser());
            $orderVO->setCreatedAt($date);
            $orderVO->setTransporterName($transporterVO->getName());
            $orderVO->setTransporterPrice($transporterVO->getPrice());
            $orderVO->setDelivry($addressVO_content);
            $orderVO->setIsPaid(0);

            $entityManager->persist($orderVO);

            // Créer le détail de la commande avec les produits / Quantité / Montant / Montant Total
            foreach ($cartVO->getFull() as $productVO) {
                $orderDetailsVO = new OrderDetails();
                $orderDetailsVO->setOrderVO($orderVO);
                $orderDetailsVO->setProduct($productVO['productVO']->getDesignation());
                $orderDetailsVO->setQuantity($productVO['quantity']);
                $orderDetailsVO->setPrice($productVO['productVO']->getPrixTTC());
                $orderDetailsVO->setTotal($productVO['productVO']->getPrixTTC() * $productVO['quantity']);
                $entityManager->persist($orderDetailsVO);
            }

            $entityManager->flush();

            return $this->render('order/recapOrder.html.twig', [
                'categoryVOs' => $categoryVOs,
                'cartVO' => $cartVO->getFull(),
                'transporterVO' => $transporterVO,
                'addressVO' => $addressVO_content,
                'reference' => $orderVO->getReference()
            ]);
        }
        // Redirect si l'utilisateur essaye d'afficher la page sans panier, transporteur, adresse, etc...
        return $this->redirectToRoute('cart');
    }
}
