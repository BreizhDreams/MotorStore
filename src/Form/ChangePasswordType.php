<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'disabled' => true,
                'label' => 'Mon Adresse Email'
            ])
            ->add('lastname', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'disabled' => true,
                'label' => 'Mon Nom'
            ])
            ->add('firstname', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'disabled' => true,
                'label' => 'Mon Prénom'
            ])
            ->add('old_password', PasswordType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Mon Mot de Passe',
                'mapped' => false,
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
                'mapped' => false,
                'required' => true,
                'first_options' => [
                    'label' => 'Mon Nouveau mot de Passe',
                    'attr' => [
                        'class' => 'form-control my-3',
                        'placeholder' => 'Nouveau mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de Passe',
                    'attr' => [
                        'class' => 'form-control my-3',
                        'placeholder' => 'Confirmer le mot de passe'
                    ]
                ],

                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => "/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,100}$/",
                        'message' => 'Le mot de passe doit au minimum contenir 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spéciale.'
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Mettre à Jour',
                'attr' => [
                    'class' => 'btn btn-success form-control',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
