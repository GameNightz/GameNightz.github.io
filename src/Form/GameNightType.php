<?php

namespace App\Form;

use App\Entity\{GameNight,Game,User};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameNightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('slots')
            ->add('ageRating')
            ->add('dateAndTime')
            ->add('describtion')
            ->add('games', EntityType::class,[
                'class'=> Game::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('visitors', EntityType::class,[
                'class'=> User::class,
                'choice_label' => 'UserName',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GameNight::class,
        ]);
    }
}
