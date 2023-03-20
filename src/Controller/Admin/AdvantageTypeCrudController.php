<?php

namespace App\Controller\Admin;

use App\Entity\AdvantageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdvantageTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdvantageType::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('reference','Référence'),
            TextField::new('designation','Désignation'),
        ];
    }
    
}
