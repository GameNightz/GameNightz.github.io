<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\{User,Game,GameNight};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', TextType::class, [

            'label' => 'email',

            'attr' => ['class' => 'required', 'placeholder' => '', 'maxlength' => '128', 'pattern' => '/@/'],

            'required' => true, 

            'constraints' => [                     

                new NotBlank([                         
                    'message' => 'Bitte geben Sie eine Email-Adresse ein.',                     
                ])
            
            ]

        ])
        ->add('userName')
        ->add('firstName')
        ->add('lastName')
        ->add('dateOfBirth')
        ->add('gender')
        ->add('preferredGames', EntityType::class,[
            'class'=> Game::class,
            'choice_label' => 'name',
            'multiple' => true,
        ])
        ->add('attends', EntityType::class, [
            'class'=> GameNight::class,
            'choice_label' => 'name',
            'multiple' => true,
        ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
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
