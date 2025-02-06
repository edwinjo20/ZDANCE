<?php

namespace App\Form;

use App\Entity\Salles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;

class SallesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomSalle', TextType::class, [
                'label' => 'La salle',
                'required' => true,
            ])
            ->add('quotaSalle', IntegerType::class, [
                'label' => 'Quota',
                'required' => true,
            ])
            ->add('adrSalle', TextType::class, [
                'label' => 'Adresse',
            ])
            ->add('cpSalle', IntegerType::class, [
                'label' => 'Code Postal',
            ])
            ->add('villeSalle', TextType::class, [
                'label' => 'Ville',
            ])
            ->add('indicationSalle', TextType::class, [
                'label' => 'Indications',
                'required' => false,
            ])
            ->add('carteSalle', UrlType::class, [
                'label' => 'Carte',
                'required' => false,
            ])
            ->add('photoSalle', FileType::class, [
                'label' => 'Photo de la salle',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '2M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp'],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPG, PNG, WEBP).',
                    ]),
                ],
            ]);

        // Ajout du champ isActive si l'option 'is_edit' est activée
        if (!empty($options['is_edit']) && $options['is_edit'] === true) {
            $builder->add('isActive', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'Actif' => true,
                    'Inactif' => false,
                ],
                'multiple' => false,
                'expanded' => true,
                'required' => false,
            ]);
        }

        $builder->add('submit', SubmitType::class, [
            'label' => 'Enregistrer',
            'attr' => ['class' => 'btn btn-primary'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Salles::class,
            'is_edit' => false, // Valeur par défaut pour éviter des erreurs
        ]);
    }
}
