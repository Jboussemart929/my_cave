<?php

namespace App\Repository;

use App\Entity\Patate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Patate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patate[]    findAll()
 * @method Patate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patate::class);
    }

    // /**
    //  * @return Patate[] Returns an array of Patate objects
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
    public function findOneBySomeField($value): ?Patate
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
