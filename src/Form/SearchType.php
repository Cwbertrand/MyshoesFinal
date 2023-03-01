<?php

namespace App\Form;

use App\Class\Search;
use App\Entity\ShoesCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('categoryinfo', TextType::class, [
            //     'label' => false,
            //     'required' => false,
            //     'attr' => [
            //         'placeholder' => 'Votre recherche...'
            //     ]
            // ] )
            ->add('categorycheckbox', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => ShoesCategory::class,
                'multiple' => true,
                'expanded' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Filter',
                'attr' => ['class' => 'btn-block btn-info']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }


    //this blocks any injection of products from the database which are not 
    //found in the query when the form is submited with or without values
    public function getBlockPrefix()
    {
        return '';
    }
}

