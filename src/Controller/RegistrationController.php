<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use App\Service\NavbarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/register', name: 'registration')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, NavbarService $navbarService): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $searchEmail = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if (!$searchEmail) {
                // encode the plain password
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                        )
                    );
                    
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                // do anything else you need here, like send an email
                $notifications = 'Votre inscription s\'est correctement déroulé. Vous pouvez des à présent vous connecter à votre compte.';

                return $userAuthenticator->authenticateUser(
                    $user,
                    $authenticator,
                    $request
                );
            }
            else
            {
                $notifications = 'L\'email que vous avez renseigner existe déja.';
            }
        }

        $navbar = $navbarService->getFullNavbar($this->entityManager , $request);

        if($navbar[1]->isSubmitted() && $navbar[1]->isValid()){
            return $this->render('product/showAllProducts.html.twig',[
                'categoryVOs' => $navbar[0],
                'productVOs' => $navbar[3],
                'form' => $navbar[2]->createView(),
                'formMenu' => $navbar[1]->createView(),
            ]);
        }
        
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'categoryVOs' => $navbar[0],
            'formMenu' => $navbar[1]->createView(),
        ]);
    }
}
