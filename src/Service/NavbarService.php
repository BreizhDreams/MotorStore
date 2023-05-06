<?php

namespace App\Service;

use App\Classe\Search;
use App\Classe\SearchBar;
use App\Entity\Category;
use App\Entity\Product;
use App\Form\SearchBarType;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class NavbarService extends AbstractController
{
    public function getFullNavbar(EntityManagerInterface $entityManager, Request $request) : array
    {
        $result = [];

        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();
        
        $searchBar = new SearchBar();
        $formMenu = $this->createForm(SearchBarType::class, $searchBar);
        $formMenu->handleRequest($request);

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        // Retourne toutes les catégories de produits
        $result[] = $categoryVOs;

        // Retourne le formulaire avec la barre de recherche et le submit
        $result[] = $formMenu;
        
        // Retourne le formulaire de filtrage dans la page produits
        $result[]= $form;

        //  BARRE DE RECHERCHE SOUMISE PAR L'UTILISATEUR
        if($formMenu->isSubmitted() && $formMenu->isValid()){
            $productVOs = $entityManager->getRepository(Product::class)->findWithSearchBar($searchBar);
            // Liste des produits correspondant à la recherche de l'user
            $result[] = $productVOs;
            
            return $result;
        }
        
        //  FORMULAIRE DE FILTRAGE DANS LA PAGE PRODUIT SAISIE PAR L'UTILISATEUR
        if($form->isSubmitted() && $form->isValid()){
            $productVOs = $entityManager->getRepository(Product::class)->findWithSearch($search);
            $result[] = $productVOs;
        }
        else{
            $productVOs = $entityManager->getRepository(Product::class)->findAll();
            //Retourne la liste complète des produits si aucune requête n'avait été faite
            $result[] = $productVOs;
        }
        
        return $result;
    }
}