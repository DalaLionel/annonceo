<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,[
                'constraints'=>[
                    new NotBlank(['message'=>'Veuillez indiquer unne adresse mail svp']),
                    new Email(['message'=>'L\'adresse entrée n\'est pas un mail'])
                ]
            ])
            
            ->add('plainPassword', RepeatedType::class, [
                'type'=>PasswordType::class,
                'invalid_message'=>'Les deux mots de passe entrés sont différents, veuillez réessayer',
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'first_options'=>['label'=>'Mot de passe'],
                'second_options'=>['label'=>'Veuillez répeter votre mot de passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit être long d\'au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('pseudo', TextType::class, [
                'constraints'=>[
                    new NotBlank(['message'=>'Veuillez entrer un pseudonyme svp']),
                    new Length(['max'=>100,'maxMessage'=>'Votre pseudo ne doit pas dépasser 100 caractères'])
                ]
            ])
            ->add('telephone', TextType::class, [
                'constraints'=>[
                    new NotBlank(['message'=>'Veuillez entrer un numéro de téléphone svp']),
                    new Length(['max'=>20, 'maxMessage'=>'Le numéro de téléphone indiqué doit avoir 20 chiffres au minimum'])
                ]
            ])
            ->add('prenom', TextType::class, [
                'constraints'=>[
                    new NotBlank(['message'=>'Veuillez entrer un prénom svp']),
                    new Length(['max'=>100,'maxMessage'=>'Votre prénom ne doit pas dépasser 100 caractères'])
                ]
            ])
            ->add('nom', TextType::class, [
                'constraints'=>[
                    new NotBlank(['message'=>'Veuillez entrer un nom svp']),
                    new Length(['max'=>100,'maxMessage'=>'Votre nom ne doit pas dépasser 100 caractères'])
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
