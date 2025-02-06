<?php

namespace App\Form;

use App\Entity\Disciplines;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class DisciplinesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isEdit = $options['is_edit'] ?? false; // Vérification sécurisée de l'option

        $builder
            ->add('nomDiscipline', TextType::class, [
                'label' => 'Nom de la Discipline',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('descriptionDiscipline', TextareaType::class, [
                'label' => 'Description',
                'required' => true,
                'attr' => ['class' => 'form-control', 'rows' => 4],
            ])
            ->add('photoDiscipline', FileType::class, [
                'label' => 'Photo de la Discipline',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '4M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp'],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPG, PNG, WEBP).',
                    ]),
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('videoDiscipline', UrlType::class, [
                'label' => 'Lien de la Vidéo',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ]);

        // Ajout du champ isActive si l'option 'is_edit' est activée
        if ($isEdit) {
            $builder->add('isActive', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'Actif' => true,
                    'Inactif' => false,
                ],
                'multiple' => false,
                'expanded' => true,
                'attr' => ['class' => 'form-check'], // Amélioration Bootstrap
            ]);
        }

        $builder->add('submit', SubmitType::class, [
            'label' => 'Enregistrer',
            'attr' => ['class' => 'btn btn-primary mt-3'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Disciplines::class,
            'is_edit' => false, // Valeur par défaut
        ]);
    }
}
