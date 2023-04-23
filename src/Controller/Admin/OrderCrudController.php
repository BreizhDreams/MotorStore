<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureActions(Actions $actions): Actions
{
    return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ->remove(Crud::PAGE_INDEX, Action::EDIT)
        ->remove(Crud::PAGE_DETAIL, Action::EDIT)
        ->remove(Crud::PAGE_INDEX, Action::DELETE)
        ->remove(Crud::PAGE_DETAIL, Action::DELETE)
    ;
}

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateTimeField::new('createdAt', 'Passer le'),
            TextField::new('userVO.getFullName', 'Utilisateur'),
            MoneyField::new('total', 'Total')->setCurrency('EUR'),
            TextField::new('transporterName','Transporteur'),
            MoneyField::new('transporterPrice', 'Frais de Port')->setCurrency('EUR'),
            BooleanField::new('isPaid', 'Payée'),
            ArrayField::new('orderDetails','Liste des Produits')->hideOnIndex()
        ];
    }
}
