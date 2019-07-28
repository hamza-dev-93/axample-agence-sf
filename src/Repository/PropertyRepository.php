<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * findAllVisible.
     *
     * @author    Hamza
     * @since    v0.0.1
     * @version    v1.0.0    Thursday, July 25th, 2019.
     * @access    public
     * @return    array
     */
    public function findAllVisible(): array
    {
        return $this->findVisibilityQuery()
            ->setParameter('valsold', false)
            ->getQuery()
            ->getResult();
    }

    /**
     * findAllVisibleQuery.
     *
     * @author    Hamza
     * @since    v1.0.0
     * @version    v1.0.0    Sunday, July 28th, 2019.
     * @access    public
     *
     */
    public function findAllVisibleQuery(PropertySearch $search = null)
    {

        $query = $this->createQueryBuilder('p')
            ->where('p.sold = :valsold')->setParameter('valsold', false);

        if ($search and $search->getMaxPrice()) {
            $query = $query->andWhere('p.price <= :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
        }
        if ($search and $search->getMinSurface()) {
            $query = $query->andWhere('p.surface >= :minsurface')
                ->setParameter('minsurface', $search->getMinSurface());
        }

        return $query->getQuery();

    }

    /**
     * findLatest.
     *
     * @author    Hamza
     * @since    v0.0.1
     * @version    v1.0.0    Thursday, July 25th, 2019.
     * @access    public
     * @return    array
     */
    public function findLatest(): array
    {
        return $this->findVisibilityQuery()
            ->setParameter('valsold', false)
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * findVisibilityQuery: partie de squelette de code query table propoerty 'p'
     *
     * @return QueryBuilder
     */
    private function findVisibilityQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold = :valsold');
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
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
public function findOneBySomeField($value): ?Property
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
