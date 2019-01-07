<?php

namespace App\Repository;

use App\Entity\RidingSchool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RidingSchool|null find($id, $lockMode = null, $lockVersion = null)
 * @method RidingSchool|null findOneBy(array $criteria, array $orderBy = null)
 * @method RidingSchool[]    findAll()
 * @method RidingSchool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RidingSchoolRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RidingSchool::class);
    }

    // /**
    //  * @return RidingSchool[] Returns an array of RidingSchool objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RidingSchool
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
