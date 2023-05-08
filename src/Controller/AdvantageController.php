<?php

namespace App\Controller;

use App\Entity\Advantage;
use App\Entity\Contain;
use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvantageController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/advantage/add/{amount}', name: 'addAdvantage')]
    public function index( Request $request, NavbarService $navbarService, int $amount): Response
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
        $fidelityCardVO = $userVO->getFidelityCardVO();

        if($amount < $fidelityCardVO->getTotalPoints()){
            $fidelityCardVO->removePoints($amount);

            $advantageVO = $this->entityManager->getRepository(Advantage::class)->findOneByAmount($amount);
           
            // on récupère dans résult un object Contain qui est censé être celui lié à la carte de fidélité et l'avantage concerné.
            $result = $this->entityManager->getRepository(Contain::class)->findAdvantageInFidelityCard($fidelityCardVO->getId(), $advantageVO->getId());
            // Si result à vide, on créer un contain avec les données correspondantes.
            if(!$result){
                $result[0] = new Contain();
                $result[0]->setFidelityCardVO($fidelityCardVO);
                $result[0]->setAdvantageVO($advantageVO);
                $result[0]->setQuantity(1);
            }
            else{
                $result[0]->setQuantity($result[0]->getQuantity()+1);
            }
            $this->entityManager->persist($result[0]);
            $this->entityManager->flush();

        }
        return $this->redirectToRoute('showFidelityBonus');
    }
}
