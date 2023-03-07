<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route("/category/new", name:"newcategory")]
    #[Route("/category/{id}/edit", name:"updatecategory")]
   
  public function GestionProprietaires(Category $categoryVO = null,
  Request $request, 
  EntityManagerInterface $manager)
  {
      
      if(!$categoryVO)
      {$categoryVO = new Category();}
      

      $form = $this->createForm(CategoryType::class,$categoryVO);

      $form->handleRequest($request);

      if(($form->isSubmitted() && $form->isValid()))
      {
          
          $manager->persist($categoryVO);
          
          $manager->flush();

          return $this->redirectToRoute('retour');
      }

      return $this->render('category/manageCategory.html.twig', [
          'form' => $form->createView(),
          'editmode' => $categoryVO->getId() !== null
      ]);
  }
}
