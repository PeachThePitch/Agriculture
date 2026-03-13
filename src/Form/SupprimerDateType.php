<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Date;


class SupprimerDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('date', EntityType::class, [
            'class' => Date::class,
            'choices' => $options['date'],
            'choice_label' => 'id',
            'expanded' => true,
            'multiple' => true,
            'label' => false, 'mapped' => false])
            ->add('supprimer', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ],'row_attr' => ['class' => 'text-center'],]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'date'=>[]
        ]);
    }
}
