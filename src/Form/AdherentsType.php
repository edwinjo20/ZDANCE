<?php

namespace App\Form;

use App\Entity\Adherents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class AdherentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAdh', TextType::class, [
                'label' => 'Nom',
                'required' => true
            ])
            ->add('prenomAdh', TextType::class, [
                'label' => 'Prénom',
                'required' => true
            ])
            ->add('repLegalAdh', TextType::class, [
                'label' => 'Représentant Légal',
                'required' => true
            ])
            ->add('sexeAdh', ChoiceType::class, [
                'label' => 'Sexe',
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                    'Autre' => 'Autre'
                ],
                'expanded' => true, // boutons radio
                'multiple' => false
            ])
            ->add('emailAdh', EmailType::class, [
                'label' => 'Email',
                'required' => true
            ])
            ->add('email2Adh', EmailType::class, [
                'label' => 'Email secondaire',
                'required' => false
            ])
            ->add('telAdh', TelType::class, [
                'label' => 'Téléphone',
                'required' => true
            ])
            ->add('tel2Adh', TelType::class, [
                'label' => 'Téléphone secondaire',
                'required' => false
            ])
            ->add('adrAdh', TextType::class, [
                'label' => 'Adresse',
                'required' => true
            ])
            ->add('cpAdh', IntegerType::class, [
                'label' => 'Code Postal',
                'required' => true
            ])
            ->add('villeAdh', TextType::class, [
                'label' => 'Ville',
                'required' => true
            ])
            ->add('dtNaissanceAdh', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'required' => true
            ])
            ->add('photoAdh', FileType::class, [
                'label' => 'Photo de l’adhérent',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '2M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp'],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPG, PNG, WEBP).',
                    ]),
                ],
            ])
            ->add('passSanitaireAdh', HiddenType::class)
            ->add('submit',SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adherents::class,
        ]);
    }
}
