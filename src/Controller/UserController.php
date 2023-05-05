<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    #[Route('/profile', name: 'profile')]
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

        return $this->render('user/profile.html.twig',[
            'categoryVOs' => $navbar[0],
            'formMenu' => $navbar[1]->createView(),
        ]);
    }

    #[Route('profile/password', name: 'editPassword')]
    public function editPassword(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher, NavbarService $navbarService): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $oldPassword = $form->get('old_password')->getData();
            if ($hasher->isPasswordValid($user, $oldPassword )){
                $newPassword = $form->get('new_password')->getData();
                $password = $hasher->hashPassword($user, $newPassword);

                $user->setPassword($password);
                $entityManager->persist($user);
                $entityManager->flush();
                
                $this->addFlash(
                    'success',
                    'Le mot de passe a été modifié.'
                );

                return $this->redirectToRoute('profile');
            }
            else{
                $this->addFlash(
                    'warning',
                    'Le mot de passe renseigné est incorrect.'
                );
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

        return $this->render('user/password.html.twig',[
            'form' => $form->createView(),
            'categoryVOs' => $navbar[0],
            'formMenu' => $navbar[1]->createView(),
        ]);
    }
}
