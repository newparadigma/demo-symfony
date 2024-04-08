<?php

namespace App\Service;

use App\Repository\ResultRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;

use App\Entity\Result;
use App\Entity\Quiz;

class ResultService
{
    private const QUIZ_ID = 1;

    private $resultRepository;
    private $entityManager;

    public function __construct(ResultRepository $resultRepository, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->resultRepository = $resultRepository;
    }

    public function makeResultFromQuiz(Quiz $quiz): Result
    {
        $result = new Result();

        // нужно сначала разобраться с формой
        // if ($quiz->isRandomizeQuestions()) {
        //     $array = $quiz->getQuestions()->toArray();
        //     shuffle($array);
        //     $quiz->setQuestions(new ArrayCollection($array));
        // }

        $result->setQuiz($quiz);

        return $result;
    }

    public function getLastWithRelations(): ?Result
    {
        return $this->resultRepository->getLastWithRelations();
    }

    public function save(Result $result): Result
    {
        $this->entityManager->persist($result);
        $this->entityManager->flush();

        foreach ($result->getResultItems() as $resultItem) {
            $this->entityManager->persist($resultItem);
        }
        $this->entityManager->flush();

        return $result;
    }
}
