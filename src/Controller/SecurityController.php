<?php

namespace App\Controller;

use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route(path: '/login', name: 'logIn')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request, NavbarService $navbarService): Response
    {
        $navbar = $navbarService->getFullNavbar($this->entityManager , $request);

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }

        if ($this->getUser()) {
            return $this->redirectToRoute('homePage',[
                'categoryVOs' => $navbar[0],
                'formMenu' => $navbar[1]->createView(),
            ]);
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
             'error' => $error,
             'categoryVOs' => $navbar[0],
             'formMenu' => $navbar[1]->createView(),
            ]);
    }

    #[Route(path: '/logout', name: 'logOut')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
