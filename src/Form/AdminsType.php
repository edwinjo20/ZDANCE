<?php

namespace App\Form;

use App\Entity\Admins;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAdm',TextType::class,['label'=>'Nom','required'=>true])
            ->add('prenomAdm',TextType::class,['label'=>'Prenom','required'=>true])
            ->add('submit',SubmitType::class,['label'=>'Enregister'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admins::class,
        ]);
    }
}
