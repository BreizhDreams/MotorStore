<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/ ', name: 'app_main')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();

        return $this->render('base.html.twig',[
            'categoryVOs' => $categoryVOs
        ]);
    }
}
