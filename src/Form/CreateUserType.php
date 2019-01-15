<?php

namespace App\Form;

use App\Entity\School;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Role;

class CreateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,[
                'label'=>'Email',
                'attr'=>['class'=>'form-control']
            ])
            ->add('password', PasswordType::class,[
                'label'=>'Mot de Passe',
                'attr'=>['class'=>'form-control']
            ])
            ->add('is_graduated', ChoiceType::class, [
                'label'=>'Sport noté ?',
                'attr'=>['class'=>'form-control'],
                'choices'=>[
                    'oui'=>'oui',
                    'non'=>'non'
                ]
            ])
            ->add('has_car', ChoiceType::class, [
                'label'=>'Voiture ?',
                'attr'=>['class'=>'form-control'],
                'choices'=>[
                    'oui'=>'oui',
                    'non'=>'non'
                ]
            ])
            ->add('firstName', TextType::class, [
                'label'=>'Prénom',
                'attr'=>['class'=>'form-control']
            ])
            ->add('lastName', TextType::class, [
                'label'=>'Nom ?',
                'attr'=>['class'=>'form-control'],
            ])
            ->add('phoneNumber', TextType::class, [
                'label'=>'Numéro de téléphone',
                'attr'=>['class'=>'form-control'],
            ])
            ->add('School', EntityType::class,[
                'class'=>School::class,
                'label'=>'Ecole',
                'attr'=>['class'=>'form-control'],
                'choice_label' => 'name'
            ])
            ->add('valider', SubmitType::class, [
                'label'=>'Créer Utilisateur',
                'attr'=>['class'=>'btn btn-primary']
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
