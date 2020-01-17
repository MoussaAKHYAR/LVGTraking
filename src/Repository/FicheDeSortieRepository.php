<?php

namespace App\Repository;

use App\Entity\FicheDeSortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FicheDeSortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheDeSortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheDeSortie[]    findAll()
 * @method FicheDeSortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheDeSortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheDeSortie::class);
    }

    // /**
    //  * @return FicheDeSortie[] Returns an array of FicheDeSortie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FicheDeSortie
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
