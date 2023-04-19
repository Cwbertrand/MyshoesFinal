<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Transporter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class CommandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user']; 
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'First name',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter your first name',
                    
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Last name',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter your last name',
                ]
            ])
            ->add('street', TextType::class,[
                'label' => 'Street',
                'required' => false,
                'attr' => [
                    'placeholder' => 'exampel: 8 Rue de lilas...'
                ]
            ])
            ->add('city', TextType::class,[
                'label' => 'City',
                'required' => false,
            ])
            ->add('postalcode', TextType::class,[
                'label' => 'Postal Code',
                'required' => false,
            ])
            ->add('country', CountryType::class,[
                'label' => 'Country',
                'required' => false,
            ])
            ->add('address', EntityType::class, [
                'label' => false,
                'required' => true,
                'class' => Address::class,
                'choices' => $user->getAddresses(),
                'multiple' => false,
                'expanded' => true
            ])
            ->add('transport', EntityType::class, [
                'label' => false,
                'required' => true,
                'class' => Transporter::class,
                'multiple' => false,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here which is from the commandcontroller 'user'
            'user' => []
        ]);
    }
}
