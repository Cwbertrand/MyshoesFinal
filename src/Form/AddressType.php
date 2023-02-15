<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class,[
            'label' => 'firstname'
        ])
        ->add('lastname', TextType::class,[
            'label' => 'lastname'
        ])
        ->add('company', TextType::class,[
            'label' => 'Company',
            'required' => false,
            'attr' => [
                'placeholder' => '(facultative) Your company...',
            ]
        ])
        ->add('street', TextType::class,[
            'label' => 'Street',
            'attr' => [
                'placeholder' => 'exampel: 8 Rue de lilas...'
            ]
        ])
        ->add('city', TextType::class,[
            'label' => 'City',
            'required' => true
        ])
        ->add('postalcode', TextType::class,[
            'label' => 'Postal Code',
            'required' => true
        ])
        ->add('country', CountryType::class,[
            'label' => 'Country',
            'required' => true
        ])
        ->add('mobile', TelType::class,[
            'label' => 'Mobile',
            'required' => true
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Save my address',
            'attr' => [
                'class' => 'my-3 bg-info'
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
