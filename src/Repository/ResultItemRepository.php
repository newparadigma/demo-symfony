<?php

namespace App\Repository;

use App\Entity\ResultItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ResultItem>
 *
 * @method ResultItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResultItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResultItem[]    findAll()
 * @method ResultItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResultItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResultItem::class);
    }
}
