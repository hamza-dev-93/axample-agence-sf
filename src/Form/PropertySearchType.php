<?php

namespace App\Form;

use App\Entity\InfoOption;
use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minSurface', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'surface minimale',
                ],
            ])
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Budget maximale',
                ],
            ])
            ->add('infoOptions', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => InfoOption::class,
                'choice_label' => 'name',
                'multiple' => true

            ])
            // ->add('submit', SubmitType::class, [
            //     'label' => ' Rechercher ',
            //     'attr' => [
            //         'class' => "btn btn-primary btn-lg",
            //     ],
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';

    }
}
