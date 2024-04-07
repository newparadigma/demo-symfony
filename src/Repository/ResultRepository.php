<?php

namespace App\Repository;

use App\Entity\Result;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Result>
 *
 * @method Result|null find($id, $lockMode = null, $lockVersion = null)
 * @method Result|null findOneBy(array $criteria, array $orderBy = null)
 * @method Result[]    findAll()
 * @method Result[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Result::class);
    }

    public function getLastWithRelations(): ?Result
    {
        $subquery = $this->createQueryBuilder('result')
        ->select('MAX(result.id)')
        ->getQuery()
        ->getOneOrNullResult();

        if ($subquery === null) {
            return null;
        }

        return $this->createQueryBuilder('result')
            ->select('result', 'quiz', 'question', 'questionAnswer', 'resultItem')
            // ->leftJoin('result.resultItems', 'resultItem')
            ->leftJoin('result.quiz', 'quiz')
            ->leftJoin('quiz.questions', 'question')
            ->leftJoin('question.questionAnswers', 'questionAnswer')
            ->leftJoin('questionAnswer.resultItems', 'resultItem')
            ->andWhere('result.id = :maxId')
            ->setParameter('maxId', $subquery[1])
            ->getQuery()
            ->getOneOrNullResult();
    }
}
