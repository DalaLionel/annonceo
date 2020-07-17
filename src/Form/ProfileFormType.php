<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints'=>[
                    new NotBlank(['message'=>'Veuillez entrer un mail svp']),
                    new Email(['message'=>'L\'email entré n\'est pas valide veuillez réessayer svp']),
                    new Length(['max'=>100, 'maxMessage'=>'Votre adresse mail ne doit pas dépasser 180 caractères'])
            ]
            ])
            ->add('pseudo', TextType::class, [
                'constraints'=>[
                    new NotBlank(['message'=>'Veuillez entrer un pseudo svp']),
                    new Length(['max'=>100, 'maxMessage'=>'Votre pseudonyme ne peut dépasser 100 caractères'])
                ]
            ])
            ->add('prenom', TextType::class, [
                'constraints'=>[
                    new NotBlank(['message'=>'Veuillez entrer un prenom svp']),
                    new Length(['max'=>100, 'maxMessage'=>'Votre prénom ne peut dépasser 100 caractères'])
                ]
            ])
            ->add('nom', TextType::class, [
                'constraints'=>[
                    new NotBlank(['message'=>'Veuillez entrer un nom svp']),
                    new Length(['max'=>100, 'maxMessage'=>'Votre nom ne peut dépasser 100 caractères'])
                ]
            ])
            ->add('telephone', TextType::class, [
                'constraints'=>[
                    new NotBlank(['message'=>'Veuillez entrer un numéro de telephone svp']),
                    new Length(['max'=>100, 'maxMessage'=>'Votre nom ne peut dépasser 100 caractères'])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
