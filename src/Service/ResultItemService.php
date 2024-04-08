<?php

namespace App\Service;

use App\Entity\ResultItem;
use App\Entity\Quiz;

use App\Repository\ResultItemRepository;

class ResultItemService
{
    private $resultItemRepository;

    public function __construct(ResultItemRepository $resultItemRepository)
    {
        $this->resultItemRepository = $resultItemRepository;
    }

    public function makeResultItemsFromQuiz(Quiz $quiz): array
    {
        $resultItems = [];
        foreach ($quiz->getQuestions() as $question) {
            foreach ($question->getQuestionAnswers() as $questionAnswer) {
                $resultItem = new ResultItem();
                $resultItem->setQuestionAnswer($questionAnswer);
                $resultItem->setChecked(false);
                $resultItems[] = $resultItem;
            }
        }

        return $resultItems;
    }
}
