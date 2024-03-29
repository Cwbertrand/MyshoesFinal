<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            //https://regex101.com/
            ->add('plainPassword', RepeatedType::class,[ 
                'type' => PasswordType::class, 
                'invalid_message' => 'The password and the confirmation password has to be identical.',
                'mapped' => false,
                'required' => true,
                'first_options' => [
                    'label' => 'Password',
                    'attr' => ['class' => 'input_resize']
                ],
                'second_options' => [
                    'label' => 'Confirmation password',
                    'attr' => ['class' => 'input_resize']
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 12,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#?!@$%^&*-])[a-zA-Z\d#?!@$%^&*-]{6,}$/',
                        'message' => 'Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character'
                    ]),
                ],
                ])
                ->add('agreeTerms', CheckboxType::class, [
                    'label' => 'I agree to the terms of use and to receive <strong class="text-primary fw-300">MyShoes</strong> emails and I acknowledge having read the <a href="#"><strong class="fw-500">privacy policy.</strong></a>',
                    'label_html' => true,
                    'mapped' => false,
                    'constraints' => [
                        new IsTrue([
                            'message' => 'You should agree to our terms.',
                        ]),
                    ],
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
