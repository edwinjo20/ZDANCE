<?php

namespace App\Form;

use App\Entity\FormuleInscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormuleInsrciptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('annee')
            ->add('codeF',TextType::class,['label'=>'Code','required'=>true])
            ->add('libelleF',TextType::class,['label'=>'Libelle','required'=>true])
            ->add('tarifF',IntegerType::class,['label'=>'Tarif'])
            ->add('tarifRenew',IntegerType::class,['label'=>'libelle'])
            ->add('ageMinF',IntegerType::class,['label'=>'Age Min'])
            ->add('ageMaxF',IntegerType::class,['label'=>'Age Max'])
            ->add('submit',SubmitType::class,[
                'label'=>'Enregister'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormuleInscription::class,
        ]);
    }
}
