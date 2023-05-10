<?php

namespace App\Controller\Admin;

use App\Entity\Limitation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class LimitationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Limitation::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('productVO','Produit'),
            IntegerField::new('limitQuantity','Quantité Maximale'),
            DateTimeField::new('startDate','Date de Début',[]),
            DateTimeField::new('endDate','Date de Fin'),

        ];
    }
}
