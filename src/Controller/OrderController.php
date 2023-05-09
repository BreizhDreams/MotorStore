<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Advantage;
use App\Entity\Contain;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Form\OrderType;
use App\Service\NavbarService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{   
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/order', name: 'showOrder')]
    public function index(Cart $cartVO, Request $request, NavbarService $navbarService): Response
    {
        if (!$this->getUser()->getAddressVOs()->getValues()) {
            return $this->redirectToRoute('addAddress');
        }

        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);

        $navbar = $navbarService->getFullNavbar($this->entityManager , $request);

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }
        if (!$cartVO->getFull()){
            return $this->redirectToRoute('homePage');
        }

        return $this->render('order/showOrder.html.twig', [
            'categoryVOs' => $navbar[0],
            'form' => $form->createView(),
            'cartVO' => $cartVO->getFull(),
            'formMenu' => $navbar[1]->createView(),
        ]);
    }

    #[Route('/order/recap', name: 'showOrderRecap')]
    public function add(Cart $cartVO, Request $request, NavbarService $navbarService): Response
    {
        if (!$this->getUser()->getAddressVOs()->getValues()) {
            return $this->redirectToRoute('addAddress');
        }
        $advantageVO = new Advantage();

        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $date = new DateTime();
            $orderVO = new Order();
            $orderVO->setHasDiscountCode(0);
            $userVO = $this->getUser();

            // Handle the discount code if user seize one 
            if ($form->get('DiscountCode')->getData() != null){
                $discountCode = $form->get('DiscountCode')->getData();
                $advantageVO = $this->entityManager->getRepository(Advantage::class)->findOneByReference($discountCode);
                if($advantageVO){
                    $containVO = $this->entityManager->getRepository(Contain::class)->findAdvantageInFidelityCard($userVO->getFidelityCardVO()->getId(), $advantageVO->getId());
                    if($containVO != null && $containVO[0]->getQuantity() != 0){
                        $orderVO->setHasDiscountCode(1);
                        $orderVO->setAdvantageVO($advantageVO);
                    }
                    else{
                        return $this->redirectToRoute('showOrder');
                    }
                }
                else{
                    return $this->redirectToRoute('showOrder',[
                        'error' => 'Ce code n\'existe pas'
                    ]);
                }
            }

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
            $reference = $date->format('dmY').'_'.uniqid();
            $orderVO->setReference($reference);
            $orderVO->setUserVO($userVO);
            $orderVO->setCreatedAt($date);
            $orderVO->setTransporterName($transporterVO->getName());
            $orderVO->setTransporterPrice($transporterVO->getPrice());
            $orderVO->setDelivry($addressVO_content);
            $orderVO->setIsPaid(0);

            $this->entityManager->persist($orderVO);

            // Créer le détail de la commande avec les produits / Quantité / Montant / Montant Total
            foreach ($cartVO->getFull() as $productVO) {
                $orderDetailsVO = new OrderDetails();
                $orderDetailsVO->setOrderVO($orderVO);
                $orderDetailsVO->setProduct($productVO['productVO']->getDesignation());
                $orderDetailsVO->setQuantity($productVO['quantity']);
                $orderDetailsVO->setPrice($productVO['productVO']->getPrixTTC());
                $orderDetailsVO->setTotal($productVO['productVO']->getPrixTTC() * $productVO['quantity']);
                $this->entityManager->persist($orderDetailsVO);
            }

            $this->entityManager->flush();

            $navbar = $navbarService->getFullNavbar($this->entityManager , $request);

            if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
                return $this->render('product/showAllProducts.html.twig',[
                    'categoryVOs' => $navbar[0],
                    'productVOs' => $navbar[3],
                    'form' => $navbar[2]->createView(),
                    'formMenu' => $navbar[1]->createView(),
                ]);
            }

            return $this->render('order/recapOrder.html.twig', [
                'categoryVOs' => $navbar[0],
                'cartVO' => $cartVO->getFull(),
                'transporterVO' => $transporterVO,
                'addressVO' => $addressVO_content,
                'reference' => $orderVO->getReference(),
                'formMenu' => $navbar[1]->createView(),
                'advantageVO' => $advantageVO,
            ]);
        }
        // Redirect si l'utilisateur essaye d'afficher la page sans panier, transporteur, adresse, etc...
        return $this->redirectToRoute('homePage');
    }
}
