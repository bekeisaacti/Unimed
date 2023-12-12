<?php

namespace App\Repository;

use App\Entity\Referencement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Referencement>
 *
 * @method Referencement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Referencement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Referencement[]    findAll()
 * @method Referencement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReferencementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Referencement::class);
    }

//    /**
//     * @return Referencement[] Returns an array of Referencement objects
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

//    public function findOneBySomeField($value): ?Referencement
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
