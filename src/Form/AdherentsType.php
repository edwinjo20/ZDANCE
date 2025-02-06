<?php

namespace App\Form;

use App\Entity\Adherents;
use App\Entity\Users;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdherentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAdh',TextType::class,[
                    'label'=>'Nom',
                    'required'=>true
                    ])
            ->add('prenomAdh',TextType::class,[
                    'label'=>'Prenom',
                    'required'=>true
                    ])
            ->add('repLegalAdh',TextType::class,[
                    'label'=>'Représentant Légal',
                    'required'=>true
                    ])
            ->add('sexeAdh')
            ->add('emailAdh',EmailType::class,[
                    'label'=>'Email',
                    'required'=>true
                    ])
            ->add('email2Adh',EmailType::class,[
                    'label'=>'Email',
                    'required'=>false
                    ])
            ->add('telAdh',TelType::class,[
                'label'=>'Telephone',
                'required'=>true
                ])
            ->add('tel2Adh',TelType::class,[
                'label'=>'Telephone 2',
                'required'=>false
                ])
            ->add('adrAdh',TextType::class,[
                'label'=>'Adresse',
                'required'=>true
                ])
            ->add('cpAdh',Integer::class,[
                'label'=>'Code Postal',
                'required'=>true
            ])
            ->add('villeAdh',TextType::class,[
                    'label'=>'','required'=>true])
            ->add('dtNaissanceAdh', DateType::class, [
                'label'=>'Date de naissance',
                'widget' => 'single_text',
                
            ])
            ->add('photoAdh')
            ->add('passSanitaireAdh',HiddenType::class)
            ->add('users', EntityType::class, [
                'class' => Users::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adherents::class,
        ]);
    }
}
