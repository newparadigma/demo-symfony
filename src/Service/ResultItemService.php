<?php

namespace App\Service;

use App\Entity\ResultItem;
use App\Entity\Quiz;

// use App\Repository\ResultRepository;

class ResultItemService
{
    // private $resultRepository;

    // public function __construct(ResultRepository $resultRepository)
    // {
    //     $this->resultRepository = $resultRepository;
    // }

    public function makeResultItemsFromQuiz(Quiz $quiz): array
    {
        $resultItems = [];
        foreach ($quiz->getQuestions() as $question) {
            foreach ($question->getQuestionAnswers() as $questionAnswer) {
                $resultItem = new ResultItem();
                $resultItem->setQuestionAnswer($questionAnswer);
                $resultItem->setChecked(false);
                // $questionAnswer->addResultItem($resultItem);
                $resultItems[] = $resultItem;
            }
        }

        return $resultItems;
    }
}
