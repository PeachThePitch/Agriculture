<?php

namespace App\Form;

use App\Entity\Date;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModifierDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ],'row_attr' => ['class' => 'text-center'],])
            ->add('modifier', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ],'row_attr' => ['class' => 'text-center'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Date::class,
        ]);
    }
}
