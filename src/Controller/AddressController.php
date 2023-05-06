<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Address;
use App\Form\AddressType;
use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddressController extends AbstractController
{
    #[Route('/profile/address', name: 'showAddress')]
    public function index(EntityManagerInterface $entityManager, Request $request, NavbarService $navbarService): Response
    {
        $navbar = $navbarService->getFullNavbar($entityManager , $request );

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }

        return $this->render('user/showAddress.html.twig', [
            'categoryVOs' => $navbar[0],
            'formMenu' => $navbar[1]->createView(),

        ]);
    }

    #[Route('/profile/addAddress', name: 'addAddress')]
    public function addAddress(EntityManagerInterface $entityManager, Request $request, Cart $cartVO, NavbarService $navbarService): Response
    {

        $addressVO = new Address();

        $form = $this->createForm(AddressType::class, $addressVO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addressVO->setUserVO($this->getUser());

            $entityManager->persist($addressVO);
            $entityManager->flush();

            if ($cartVO->get()) {
                return $this->redirectToRoute('showOrder');
            } else {
                return $this->redirectToRoute('showAddress');
            }
        }

        $navbar = $navbarService->getFullNavbar($entityManager , $request );

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }
        
        return $this->render('user/addAddress.html.twig', [
            'form' => $form->createView(),
            'categoryVOs' => $navbar[0],
            'formMenu' => $navbar[1]->createView(),
        ]);
    }

    #[Route('/profile/editAddress/{id}', name: 'editAddress')]
    public function editAddress(EntityManagerInterface $entityManager, Request $request, int $id, NavbarService $navbarService): Response
    {

        $addressVO = $entityManager->getRepository(Address::class)->findOneById($id);
        if (!$addressVO || $addressVO->getUserVO()  != $this->getUser()) {
            return $this->redirectToRoute('showAddress');
        }

        $form = $this->createForm(AddressType::class, $addressVO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('showAddress');
        }

        $navbar = $navbarService->getFullNavbar($entityManager , $request );

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }
        
        return $this->render('user/addAddress.html.twig', [
            'form' => $form->createView(),
            'categoryVOs' => $navbar[0],
            'formMenu' => $navbar[1]->createView(),
        ]);
    }

    #[Route('/profile/removeAddress/{id}', name: 'removeAddress')]
    public function removeAddress(EntityManagerInterface $entityManager, $id): Response
    {
        $addressVO = $entityManager->getRepository(Address::class)->findOneById($id);

        if ($addressVO && $addressVO->getUserVO() == $this->getUser()) {
            $entityManager->remove($addressVO);
            $entityManager->flush();
        }
        return $this->redirectToRoute('showAddress');
    }
}
