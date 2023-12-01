<?php

namespace App\Form;

use App\Entity\{Game,GameNight,User};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('inNights', EntityType::class,[
                'class'=> GameNight::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('likedBy', EntityType::class,[
                'class'=> User::class,
                'choice_label' => 'UserName',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
