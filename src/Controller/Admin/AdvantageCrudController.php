<?php

namespace App\Controller\Admin;

use App\Entity\Advantage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdvantageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Advantage::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('reference','Référence'),
            TextField::new('advantageName','Nom'),
            DateTimeField::new('expirationDate','Date d\'expiration'),
            AssociationField::new('advantageTypeVO','Type d\'avantage'),
        ];
    }
    
}
