<?php

namespace App\Repository;

use App\Entity\Recherches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Recherches|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recherches|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recherches[]    findAll()
 * @method Recherches[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecherchesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Recherches::class);
    }

//    /**
//     * @return Recherches[] Returns an array of Recherches objects
//     */
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
    public function findOneBySomeField($value): ?Recherches
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
