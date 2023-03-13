<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Form\BrandType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrandController extends AbstractController
{
    #[Route('/brand', name: 'app_brand')]
    public function index(): Response
    {
        return $this->render('brand/index.html.twig', [
            'controller_name' => 'BrandController',
        ]);
    }
    
    #[Route("/brand/new", name:"newbrand")]
    #[Route("/brand/{id}/edit", name:"updatebrand")]
   
  public function BrandManager(Brand $brandVO = null,
  Request $request, 
  EntityManagerInterface $manager)
  {
      
      if(!$brandVO)
      {$brandVO = new Brand();}
      

      $form = $this->createForm(BrandType::class,$brandVO);

      $form->handleRequest($request);

      if(($form->isSubmitted() && $form->isValid()))
      {
          
          $manager->persist($brandVO);
          
          $manager->flush();

          return $this->redirectToRoute('retour');
      }

      return $this->render('brand/manageBrand.html.twig', [
          'form' => $form->createView(),
          'editmode' => $brandVO->getId() !== null
      ]);
  }
}
