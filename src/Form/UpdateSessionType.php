<?php

namespace App\Form;

use App\Entity\Level;
use App\Entity\RidingSchool;
use App\Entity\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateSessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>'Nom',
                'attr'=>['class'=>'form-control']
            ])
            ->add('level', EntityType::class, [
                'class'=>Level::class,
                'label'=>'Niveau',
                'choice_label'=>'name',
                'attr'=>['class'=>'form-control'],
                'multiple'=>true
            ])
            ->add('ridingSchool', EntityType::class, [
                'class'=>RidingSchool::class,
                'label'=>'Ecole d\'équitation',
                'choice_label' => 'name',
                'attr'=>['class'=>'form-control']
            ])
            ->add('day', ChoiceType::class, [
                'label'=>'Jour',
                'attr'=>['class'=>'form-control'],
                'choices'=>[
                    'lundi'=>'lundi',
                    'mardi'=>'mardi',
                    'mercredi'=>'mercredi',
                    'jeudi'=>'jeudi',
                    'vendredi'=>'vendredi',
                    'samedi'=>'samedi'
                ]
            ])
            ->add('hour', TimeType::class, [
                'label'=>'Heure',
                'attr'=>['class'=>'form-control']
            ])
            ->add('price', TextType::class, [
                'label'=>'Tarif',
                'attr'=>['class'=>'form-control']
            ])
            ->add('number_places', IntegerType::class,[
                'label'=>'Nombre de places',
                'attr'=>['class'=>'form_control']
            ])
            ->add('description', TextareaType::class, [
                'label'=>'Description',
                'attr'=>['class'=>'form-control']
            ])
            ->add('submit', SubmitType::class, [
                'label'=>'Enregistrer',
                'attr'=>['class'=>'btn btn-primary']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
