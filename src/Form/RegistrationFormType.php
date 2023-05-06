<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName',TextType::class,[
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Prénom'

            ])
            ->add('lastName', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom de Famille'
            ])
            ->add('birthDate',BirthdayType::class,[
                'label' => 'Date de Naissance'

            ])
            ->add('email',EmailType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Adresse email'

            ])
            ->add('address',TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Adresse'

            ])
            ->add('zipCode',TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Code Postal',
                'constraints' => [
                    new Regex([
                        'pattern' => "/^(?:0[1-9]|[1-8]\d|9[0-8])\d{3}$/",
                        'message' => 'Le code postal doit être composer de 5 chiffres (ex: 22300).'
                    ]),
                ],
            ])
            ->add('city',TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Ville'
            ])
            ->add('telNumber', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Numéro de Téléphone',
                'constraints' => [
                    new Regex([
                        'pattern' => "/^((\+)33|0)[1-9](\d{2}){4}$/",
                        'message' => 'Le numéro de téléphone saisie à un format incorrect, merci de saisir un numéro de téléphone correct.'
                    ]),
                ],

            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'label' => 'En m\'inscrivant à ce site, j\'accepte les conditions réglementaires '
            ])
            ->add('password', RepeatedType::class, [
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
                'label' => 'M\'inscrire',
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
