<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Transporter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];
        $builder
            ->add('Adresses', EntityType::class, [
                'label' => false,
                'required' => true,
                'class' => Address::class,
                'choices' => $user->getAddressVOs(),
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('Transporter', EntityType::class, [
                'label' => false,
                'required' => true,
                'class' => Transporter::class,
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('DiscountCode',TextType::class,[
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
                'help' => 'En cas de code Invalide, vous serez redirigez sur cette page.'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider la commande',
                'attr' => [
                    'class' => 'btn btn-block btn-success '
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user' => array()
        ]);
    }
}
