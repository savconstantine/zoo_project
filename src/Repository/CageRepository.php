<?php

namespace App\Repository;

use App\Entity\Cage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cage[]    findAll()
 * @method Cage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cage::class);
    }

    public function getCages(int $page, int $perPage)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('a')
            ->from($this->getClassName(), 'a')
            ->orderBy('a.id', 'DESC')
            ->setFirstResult($perPage * $page)
            ->setMaxResults($perPage);

        return $queryBuilder->getQuery()->getResult();
    }

    // /**
    //  * @return Cage[] Returns an array of Cage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cage
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
