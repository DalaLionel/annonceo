<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', RepeatedType::class, [
                'type'=>PasswordType::class,
                'invalid_message'=>'Les mots de passe entrés ne sont pas identiques, veuillez réessayer',
                'first_options'=>(['label'=>'Votre nouveau mot de passe']),
                'second_options'=>(['label'=>'Veuillez répéter le mot de passe']),
                'constraints'=>[
                    new NotBlank(['message'=>'Veuillez saisir un mot de passe']),
                    new Length([
                        'min'=>6, 'minMessage'=>'Votre mot de passe doit être long d\'au moins 6 caractères',
                        'max'=>4096
                    ])
                ]
            ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
