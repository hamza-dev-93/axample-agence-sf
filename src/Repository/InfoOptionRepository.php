<?php

namespace App\Repository;

use App\Entity\InfoOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InfoOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoOption[]    findAll()
 * @method InfoOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoOptionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InfoOption::class);
    }

    // /**
    //  * @return InfoOption[] Returns an array of InfoOption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InfoOption
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
