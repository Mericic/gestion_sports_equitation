<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $roles=['role 1', 'role 2'];
        $builder
            ->add('firstName', TextType::class, [
                'label'=>'Prénom',
                'attr'=>['class'=>'form-control']
            ])
            ->add('lastName', TextType::class, [
                'label'=>'Nom',
                'attr'=>['class'=>'form-control']
            ])
            ->add('email', EmailType::class, [
                'label'=>'Adresse Email',
                'attr'=>['class'=>'form-control']
            ])
            ->add('roles', ChoiceType::class, [
                'label'=>'Role Utilisateur',
                'attr'=>['class'=>'form-control'],
                'choices'=>[
                    'Etudiant'=>'etudiant',
                    'Enseignant'=>'enseignant',
                    'Admin'=>'admin',
                    'SuperAdmin'=>'super admin'
                ]
            ])
            ->add('password', PasswordType::class,[
                'label'=>'Mot de Passe',
                'attr'=>['class'=>'form-control']
            ])
            ->add('is_graduated', ChoiceType::class,[
                'label'=>'noté ?',
                'attr'=>['class'=>'form-control'],
                'choices'=>[
                    'oui'=>'oui',
                    'non'=>'non'
                ]
            ])
            ->add('has_car', ChoiceType::class,[
                'label'=>'covoiturage ?',
                'attr'=>['class'=>'form-control']
            ])
            ->add('phoneNumber', NumberType::class,[
                'label'=>'Numéro de Téléphone',
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
