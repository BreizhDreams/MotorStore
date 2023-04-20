<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Address;
use App\Entity\Category;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddressController extends AbstractController
{
    #[Route('/profile/address', name: 'showAddress')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();


        return $this->render('user/address.html.twig', [
            'categoryVOs' => $categoryVOs
        ]);
    }

    #[Route('/profile/addAddress', name: 'addAddress')]
    public function addAddress(EntityManagerInterface $entityManager, Request $request, Cart $cartVO): Response
    {

        $addressVO = new Address();

        $form = $this->createForm(AddressType::class, $addressVO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addressVO->setUserVO($this->getUser());

            $entityManager->persist($addressVO);
            $entityManager->flush();

            if ($cartVO->get()) {
                return $this->redirectToRoute('order');
            } else {
                return $this->redirectToRoute('showAddress');
            }
        }

        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();

        return $this->render('user/addAddress.html.twig', [
            'form' => $form->createView(),
            'categoryVOs' => $categoryVOs
        ]);
    }

    #[Route('/profile/editAddress/{id}', name: 'editAddress')]
    public function editAddress(EntityManagerInterface $entityManager, Request $request, int $id): Response
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

        $categoryVOs = $entityManager->getRepository(Category::class)->findAll();

        return $this->render('user/addAddress.html.twig', [
            'form' => $form->createView(),
            'categoryVOs' => $categoryVOs
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
