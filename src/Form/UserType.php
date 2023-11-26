<?php

namespace App\Form;

use App\Entity\{User,Game,GameNight};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('userName')
            ->add('userName', TextType::class, [
                'attr' => ['class' => 'meine_hardcore_geile_css_klasse']
            ])
            ->add('firstName')
            ->add('lastName')
            ->add('dateOfBirth')
            ->add('gender')
            //->add('roles')
            ->add('isVerified')
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
