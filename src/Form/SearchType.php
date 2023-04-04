<?php 

namespace App\Form;

use App\Classe\Search;
use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\SubCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('string', TextType::class, [
                'label' => 'Rechercher : ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher',
                    'class' => 'form-control'
                ]
                ])
            ->add('categoryVOs', EntityType::class ,[
                'label' => 'Catégorie : ',
                'required' => false,
                'class' => Category::class,
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-check',
                ]
            ])
            ->add('subCategoryVOs', EntityType::class ,[
                'label' => 'Sous-Catégorie :',
                'required' => false,
                'class' => SubCategory::class,
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-check'
                ]
            ])
            ->add('brandVOs', EntityType::class ,[
                'label' => 'Marque :',
                'required' => false,
                'class' => Brand::class,
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-check',
                ]
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Rechercher',
                'attr' => [
                    'class' => 'btn btn-block btn-primary'
                ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'csrf_protection' => false,

        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}