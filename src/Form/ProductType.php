<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('designation')
            ->add('prixTTC')
            ->add('photoURL')
            ->add('categoryVO', EntityType::class, array(
                'class'        => Category::class,
                'choice_label' => 'designation',
                'multiple' => false ))
            ->add('brandVO', EntityType::class, array(
                'class'        => Brand::class,
                'choice_label' => 'name',
                'multiple' => false ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}