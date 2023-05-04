<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Quel nom souhaitez-vous pour attribuer à cette adresse ?',
                'attr' => [
                    'placeholder' => 'Nom ..',
                    'class' => 'form-control mt-2',
                    
                ]
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Votre Prénom',
                'attr' => [
                    'placeholder' => 'Prénom ..',
                    'class' => 'form-control mt-2',
                    
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Votre Nom de Famille',
                'attr' => [
                    'placeholder' => 'Nom de Famille..',
                    'class' => 'form-control mt-2',
                    
                ]
            ])
            ->add('company', TextType::class, [
                'label' => 'Nom de votre Entreprise',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entreprise .. (facultatif)',
                    'class' => 'form-control mt-2',
                    
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Votre adresse',
                'attr' => [
                    'placeholder' => 'Adresse',
                    'class' => 'form-control mt-2',
                    
                ]
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Votre code postal',
                'attr' => [
                    'placeholder' => 'Code Postal..',
                    'class' => 'form-control mt-2',
                    
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Votre ville',
                'attr' => [
                    'placeholder' => 'Ville ..',
                    'class' => 'form-control mt-2',
                    
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Votre pays',
                'attr' => [
                    'placeholder' => 'Pays ..',
                    'class' => 'form-control mt-2',
                    
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Votre numéro de téléphone',
                'attr' => [
                    'placeholder' => 'Numéro de Téléphone',
                    'class' => 'form-control mt-2',
                ]
            ])
            ->add('submit',SubmitType::class,[
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-block btn-dark my-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
