<?php

namespace App\Form;

use App\Entity\School;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez saisir votre prénom'
                    ])
                ],
                'label'=>'Prénom',
                'attr'=>['class'=>'form-control']
            ])
            ->add('lastName', TextType::class, [
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez saisir votre nom'
                    ])
                ],
                'label'=>'Nom',
                'attr'=>['class'=>'form-control']
            ])
            ->add('email', EmailType::class,[
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez entrer une adresse email'
                    ]),
                ],
                'attr'=>['class'=>'form-control']
            ])
            ->add('phoneNumber', IntegerType::class, [
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez saisir votre numéro de téléphone'
                    ])
                ],
                'label'=>'Numéro de téléphone',
                'attr'=>['class'=>'form-control']
            ])
            ->add('is_Graduated', ChoiceType::class, [
                'label'=>'Sport Noté ?',
                'attr'=>['required'=>'false', 'class'=>'form-control'],
                'choices'=>[
                    'oui'=>'oui',
                    'non'=>'non'
                ]
            ])
            ->add('has_Car', ChoiceType::class, [
                'label'=>'Avez vous une voiture (covoiturage) ?',
                'attr'=>['required'=>'false', 'class'=>'form-control'],
                'choices'=>[
                    'oui'=>'oui',
                    'non'=>'non'
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'label'=>'Mot de passe',
                'attr'=>['class'=>'form-control']
            ])
            ->add('school', EntityType::class, [
                'label'=>'Ecole',
                'class'=>School::class,
                'choice_label' => 'name',
                'attr'=>['class'=>'form-control']
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
