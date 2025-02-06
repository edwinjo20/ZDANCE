<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Disciplines;
use App\Entity\Profs;
use App\Entity\Salles;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isEdit = $options['is_edit'] ?? false; // Vérification sécurisée de l'option
        
        $jourCours = [
            'Lundi' => 1,
            'Mardi' => 2,
            'Mercredi' => 3,
            'Jeudi' => 4,
            'Vendredi' => 5,
            'Samedi' => 6,
            'Dimanche' => 7,
        ];

        $builder
            ->add('discipline', EntityType::class, [
                'class' => Disciplines::class,
                'choice_label' => 'nomDiscipline',
                'label' => 'Discipline',
                'required' => true,
            ])
            ->add('professeur', EntityType::class, [
                'class' => Profs::class,
                'choice_label' => 'nomProfs',
                'label' => 'Professeur',
                'required' => true,
            ])
            ->add('salles', EntityType::class, [
                'class' => Salles::class,
                'choice_label' => 'nomSalle',
                'label' => 'Salle',
                'required' => true,
            ])
            ->add('jourCours', ChoiceType::class, [
                'label' => 'Jour du cours',
                'choices' => $jourCours,
                'expanded' => false,
                'multiple' => false,
                'required' => true,
            ])
            ->add('heureCours', TimeType::class, [
                'label' => 'Heure du cours',
                'input' => 'datetime',
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('dureeCours', IntegerType::class, [
                'label' => 'Durée (minutes)',
                'required' => true,
            ])
            ->add('ageMinCours', IntegerType::class, [
                'label' => 'Âge Minimum',
                'required' => true,
            ])
            ->add('ageMaxCours', IntegerType::class, [
                'label' => 'Âge Maximum',
                'required' => true,
            ]);

        if ($isEdit) {
            $builder
                ->add('isActive', ChoiceType::class, [
                    'label' => 'Statut',
                    'choices' => [
                        'Actif' => true,
                        'Inactif' => false,
                    ],
                    'multiple' => false,
                    'expanded' => true,
                    'attr' => ['class' => 'form-check'],
                ])
                ->add('isFull', ChoiceType::class, [
                    'label' => 'Complet',
                    'choices' => [
                        'Oui' => true,
                        'Non' => false,
                    ],
                    'multiple' => false,
                    'expanded' => true,
                    'attr' => ['class' => 'form-check'],
                ]);
        }

        $builder->add('submit', SubmitType::class, [
            'label' => 'Ajouter',
            'attr' => ['class' => 'btn btn-primary'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
            'is_edit' => false,
        ]);
    }
}
