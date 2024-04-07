<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Account;
use App\Entity\Quiz;
use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\QuestionAnswer;

class AppFixtures extends Fixture
{
    private const QUIZ_NAME = 'Тест на сложение чисел';

    public function load(ObjectManager $manager): void
    {
        $account = new Account();
        $manager->persist($account);

        $quiz = new Quiz();
        $quiz->setName(self::QUIZ_NAME);
        $quiz->setRandomizeQuestions(true);
        $manager->persist($quiz);

        for ($i = 1; $i < 11; $i++) {
            $question = new Question();
            $question->setContent("$i + $i = ?");
            $manager->persist($question);

            $quiz->addQuestion($question);

            $sum = $i + $i;

            $map = [
                "$sum" => true,
                $sum + 1 . ' - 1' => true,
                "$sum + 1" => false,
                "$sum + 2" => false,
            ];

            foreach ($map as $content => $isCorrect) {
                $answer = new Answer();
                $answer->setContent($content);
                $manager->persist($answer);

                $questionAnswer = new QuestionAnswer();
                $questionAnswer->setQuestion($question);
                $questionAnswer->setAnswer($answer);
                $questionAnswer->setIsCorrect($isCorrect);
                $manager->persist($questionAnswer);
            }
        }

        $manager->flush();
    }
}
