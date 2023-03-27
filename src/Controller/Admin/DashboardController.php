<?php

namespace App\Controller\Admin;

use App\Entity\Advantage;
use App\Entity\AdvantageType;
use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\SubCategory;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator){
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(CategoryCrudController::class)->generateUrl();
        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Motor\'Store');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Navigation');
        yield MenuItem::linkToDashboard('Accueil du Panel', 'fa fa-home');
        yield MenuItem::linkToRoute('Quitter le panel Admin', 'fa fa-arrow-left','app_main');
        
        yield MenuItem::section('Utilisateur');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajout Utilisateur', 'fas fa-add', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les Utilisateurs', 'fas fa-eye', User::class)
        ]);

        yield MenuItem::section('Catégories');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajout Catégorie', 'fas fa-add', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les Catégories', 'fas fa-eye', Category::class)
        ]);

        yield MenuItem::section('Sous-Catégories');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajout Sous-Catégorie', 'fas fa-add', SubCategory::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les Sous-Catégories', 'fas fa-eye', SubCategory::class)
        ]);

        yield MenuItem::section('Produits');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajout Produit', 'fas fa-add', Product::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les Produits', 'fas fa-eye', Product::class)
        ]);

        yield MenuItem::section('Marques');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajout Marque', 'fas fa-add', Brand::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les Marques', 'fas fa-eye', Brand::class)
        ]);

        yield MenuItem::section('Type d\'Avantages');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajout Types Avantages', 'fas fa-add', AdvantageType::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les Types d\'Avantages', 'fas fa-eye', AdvantageType::class)
        ]);

        yield MenuItem::section('Avantages');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajout Avantage', 'fas fa-add', Advantage::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les Avantages', 'fas fa-eye', Advantage::class)
        ]);

    }
}
