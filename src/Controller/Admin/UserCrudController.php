<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('email','Adresse Mail'),
            TextField::new('password','Mots de Passe'),
            TextField::new('lastName','Nom de Famille'),
            TextField::new('firstName','Prénom'),
            TextField::new('address','Adresse'),
            TextField::new('zipCode','Code Postal'),
            TextField::new('city','Ville'),
            TextField::new('telNumber','Numéro de Téléphone'),
            DateField::new('birthDate','Date de Naissance'),
        ];
    }
    
}
