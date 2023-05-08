<?php

namespace App\Controller;

use App\Entity\Advantage;
use App\Entity\FidelityCard;
use App\Entity\Order;
use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FidelityCardController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/fidelity_card/show', name: 'showFidelityProgram')]
    public function index( Request $request, NavbarService $navbarService): Response
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

        if (!$this->getUser() || !$this->getUser()->getFidelityCardVO()){
            return $this->render('fidelity_card/showProgram.html.twig',[
                'categoryVOs' => $navbar[0],
                'formMenu' => $navbar[1]->createView(),
            ]);
        }
        else{    
            return $this->redirectToRoute('showFidelityBonus');
        }
    }

    #[Route('/fidelity_card/bonus', name: 'showFidelityBonus')]
    public function showFidelityBonus( Request $request, NavbarService $navbarService): Response
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

        $userVO = $this->getUser();

        if($userVO){
            if(!$userVO->getFidelityCardVO()){
                $fidelityCardVO = new FidelityCard();
                $fidelityCardVO->setReference(uniqid());
                $fidelityCardVO->setTotalPoints(0);
                $fidelityCardVO->setUserVO($userVO);
                $userVO->setFidelityCardVO($fidelityCardVO);
    
                $this->entityManager->persist($fidelityCardVO);
                $this->entityManager->flush();
            }
            $orderVOs = $this->entityManager->getRepository(Order::class)->findSuccessOrders($userVO);
            $advantageVOs = $this->entityManager->getRepository(Advantage::class)->findAdvantageInEuro();
    
            return $this->render('fidelity_card/showFidelityBonus.html.twig',[
                'categoryVOs' => $navbar[0],
                'formMenu' => $navbar[1]->createView(),
                'orderVOs' => $orderVOs,
                'advantageVOs' => $advantageVOs
            ]);
        }
    }
}
