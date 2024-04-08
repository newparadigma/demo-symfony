<?php

namespace App\Form\MathTest;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\ResultItem;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Translation\TranslatableMessage;


class ResultItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('checked', CheckboxType::class, [
            'required' => false,
            // 'mapped' => false,
            // 'data' => function ($questionAnswer) {
            //     return $questionAnswer->getId();
            //     // return new TranslatableMessage('question_answer', ['%question%' => $questionAnswer->getQuestion()->getQuestion()]);
            // },
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ResultItem::class,
        ]);
    }
}
