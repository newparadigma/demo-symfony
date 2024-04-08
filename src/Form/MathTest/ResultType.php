<?php

namespace App\Form\MathTest;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use App\Entity\Result;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ResultType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quiz', QuizType::class, [
                'mapped' => false,
            ])
            ->add('resultItems', CollectionType::class, [
                'entry_type' => ResultItemType::class
            ]);
            // ->add('resultItems', CollectionType::class, [
            //     'entry_type' => CheckboxType::class,
            //     'entry_options' => [
            //         'label' => false,
            //         'required' => false,
            //     ],
            //     'by_reference' => false,
            //     // 'data' => 'abcdef',
            // ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Result::class,
        ]);
    }
}

