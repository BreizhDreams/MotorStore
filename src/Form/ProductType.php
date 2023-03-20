<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\SubCategory;
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
            ->add('brandVO', EntityType::class, array(
                'class'        => Brand::class,
                'choice_label' => 'name',
                'multiple' => false ))
            ->add('categoryVO', EntityType::class, array(
                'class'        => Category::class,
                'choice_label' => 'designation',
                'multiple' => false ))
            ->add('subCategoryVO', EntityType::class, array(
                'class'        => SubCategory::class,
                'choice_label' => 'designation',
                'muliple' => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}