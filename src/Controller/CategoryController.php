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

    #[Route("/admin/category/new", name: "newcategory")]
    #[Route("/admin/category/{id}/edit", name: "updatecategory")]
    public function CategoryManager(
        Category $categoryVO = null,
        Request $request,
        EntityManagerInterface $manager
    ) {
        if (!$categoryVO) {
            $categoryVO = new Category();
        }


        $form = $this->createForm(CategoryType::class, $categoryVO);

        $form->handleRequest($request);

        if (($form->isSubmitted() && $form->isValid())) {

            $manager->persist($categoryVO);

            $manager->flush();

            return $this->redirectToRoute('retour');
        }

        return $this->render('admin/manageCategory.html.twig', [
            'form' => $form->createView(),
            'editmode' => $categoryVO->getId() !== null
        ]);
    }
}
