<?php

namespace App\Repository;

use App\Entity\Quiz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Quiz>
 *
 * @method Quiz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quiz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quiz[]    findAll()
 * @method Quiz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quiz::class);
    }

    public function getWithRelationsByID(int $quizId): ?Quiz
    {
        return $this->createQueryBuilder('q')
            ->select('q', 'question', 'questionAnswer', 'answer')
            ->leftJoin('q.questions', 'question')
            ->leftJoin('question.questionAnswers', 'questionAnswer')
            ->leftJoin('questionAnswer.answer', 'answer')
            ->where('q.id = :quizId')
            ->setParameter('quizId', $quizId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
