<?php

namespace App\Repository;

use App\Entity\PointDinteret;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PointDinteret|null find($id, $lockMode = null, $lockVersion = null)
 * @method PointDinteret|null findOneBy(array $criteria, array $orderBy = null)
 * @method PointDinteret[]    findAll()
 * @method PointDinteret[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointDinteretRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PointDinteret::class);
    }

    // /**
    //  * @return PointDinteret[] Returns an array of PointDinteret objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PointDinteret
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
