<?php

namespace App\Controller;

use App\Entity\SubCategory;
use App\Form\SubCategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubCategoryController extends AbstractController
{
    #[Route('/sub/category', name: 'app_sub_category')]
    public function index(): Response
    {
        return $this->render('sub_category/index.html.twig', [
            'controller_name' => 'SubCategoryController',
        ]);
    }

    #[Route("/subcategory/new", name: "newsubcategory")]
    #[Route("/subcategory/{id}/edit", name: "updatesubcategory")]
    public function SubCategoryManager(
        SubCategory $subCategoryVO = null,
        Request $request,
        EntityManagerInterface $manager
    ) {
        if (!$subCategoryVO) {
            $subCategoryVO = new SubCategory();
        }


        $form = $this->createForm(SubCategoryType::class, $subCategoryVO);

        $form->handleRequest($request);

        if (($form->isSubmitted() && $form->isValid())) {

            $manager->persist($subCategoryVO);

            $manager->flush();

            return $this->redirectToRoute('retour');
        }

        return $this->render('sub_category/manageSubCategory.html.twig', [
            'form' => $form->createView(),
            'editmode' => $subCategoryVO->getId() !== null
        ]);
    }
}
