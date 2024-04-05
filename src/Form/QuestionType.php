<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $builder
        //     ->add('answers', CollectionType::class, [
        //         'entry_type' => CheckboxType::class,
        //         'entry_options' => [
        //             // 'label' => function ($answer) { // Текст для каждого чекбокса будет браться из свойства content объекта Answer
        //             //     return $answer->getContent();
        //             // },
        //             'data' => true, // Принудительно устанавливаем значение на true для каждого чекбокса
        //         ],
        //     ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
