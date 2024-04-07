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

    // public function batchInsert(array $data)
    // {
    //     foreach ($data as $item) {
    //         $entity = new ResultItem();
    //         $entity->setProp1($item['prop1']);
    //         $entity->setProp2($item['prop2']);
    //         // Установите другие свойства сущности по вашему усмотрению
            
    //         $this->entityManager->persist($entity);
    //     }

    //     $this->entityManager->flush();
    // }

    //    /**
    //     * @return ResultItem[] Returns an array of ResultItem objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ResultItem
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
