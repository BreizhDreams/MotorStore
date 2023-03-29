<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/ ', name: 'app_main')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $productVOs = $entityManager->getRepository(Product::class)->findAll();

        return $this->render('main/index.html.twig',[
            'productVOs' => $productVOs
        ]);
    }
}
