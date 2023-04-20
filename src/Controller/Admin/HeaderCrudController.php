<?php

namespace App\Controller\Admin;

use App\Entity\Header;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HeaderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Header::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title','Titre du Header'),
            TextareaField::new('content','Contenu du Header'),
            TextField::new('btnTitle','Titre du bouton'),
            TextField::new('btnUrl','Url de Destination du Bouton'),
            ImageField::new('imageURL','Lien de la Photo')->setBasePath('uploads/utility/')->setUploadDir('public/uploads/utility/'),

        ];
    }
    
}
