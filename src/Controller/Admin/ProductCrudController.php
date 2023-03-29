<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('brandVO','Marque'),
            TextField::new('designation', 'Désignation'),
            SlugField::new('slug')->setTargetFieldName('designation'),
            MoneyField::new('prixTTC', 'Prix en €')->setCurrency('EUR'),
            TextField::new('photoURL','Lien de la Photo'),
            AssociationField::new('categoryVO','Catégorie'),
            AssociationField::new('subCategoryVO','Sous-Catégorie'),

        ];
    }
    
}
