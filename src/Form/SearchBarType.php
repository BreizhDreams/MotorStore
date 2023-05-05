<?php 

namespace App\Form;

use App\Classe\SearchBar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchBarType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search', TextType::class, [
                'label' => '',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher un produit',
                    'class' => 'form-control',
                ]
                ])
            ->add('submit', SubmitType::class,[
                'label' => 'Rechercher',
                'attr' => [
                    'class' => 'btn btn-block btn-success'
                ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchBar::class,
            'method' => 'GET',
            'csrf_protection' => false,

        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}