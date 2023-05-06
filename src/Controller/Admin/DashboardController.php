<?php

namespace App\Controller\Admin;

use App\Entity\Advantage;
use App\Entity\AdvantageType;
use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Header;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\SubCategory;
use App\Entity\Transporter;
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
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(OrderCrudController::class)->generateUrl();
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
        yield MenuItem::linkToRoute('Quitter le panel Admin', 'fa fa-arrow-left', 'homePage');

        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-add', User::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-add', Order::class);
        yield MenuItem::linkToCrud('Catégorie', 'fas fa-add', Category::class);
        yield MenuItem::linkToCrud('Sous-Catégorie', 'fas fa-add', SubCategory::class);
        yield MenuItem::linkToCrud('Produit', 'fas fa-add', Product::class);
        yield MenuItem::linkToCrud('Marque', 'fas fa-add', Brand::class);
        yield MenuItem::linkToCrud('Types Avantages', 'fas fa-add', AdvantageType::class);
        yield MenuItem::linkToCrud('Avantage', 'fas fa-add', Advantage::class);
        yield MenuItem::linkToCrud('Transporteur', 'fas fa-add', Transporter::class);
        yield MenuItem::linkToCrud('Header', 'fas fa-add', Header::class);
    }
}
