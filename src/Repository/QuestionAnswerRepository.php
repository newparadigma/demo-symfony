<?php

namespace App\Repository;

use App\Entity\QuestionAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuestionAnswer>
 *
 * @method QuestionAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionAnswer[]    findAll()
 * @method QuestionAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionAnswer::class);
    }
}
