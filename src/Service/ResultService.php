<?php

namespace App\Service;

use App\Repository\ResultRepository;

class ResultService
{
    private const QUIZ_ID = 1;

    private $resultRepository;

    public function __construct(ResultRepository $resultRepository)
    {
        $this->resultRepository = $resultRepository;
    }

    public function getQuizWithQuestionsAndAnswers()
    {
        // $quiz = $this->quizRepository->getDenormalizedDataByID(self::QUIZ_ID);
        // dd($quiz[0]->getQuizQuestions());
        // Бизнес-логика обработки заказа
        // Например, сохранение заказа в базу данных
        // $this->orderRepository->save($order);
    }
}
