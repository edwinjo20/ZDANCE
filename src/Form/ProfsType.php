<?php

namespace App\Form;

use App\Entity\Profs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomProf')
            ->add('prenomProf')
            ->add('telProf')
            ->add('emailProf')
            ->add('tel2Prof')
            ->add('photoProf')
            ->add('presentationProf')
            ->add('indexProf')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profs::class,
        ]);
    }
}
