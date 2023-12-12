<?php

namespace App\Repository;

use App\Entity\ServiceUrgence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ServiceUrgence>
 *
 * @method ServiceUrgence|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceUrgence|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceUrgence[]    findAll()
 * @method ServiceUrgence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceUrgenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceUrgence::class);
    }

//    /**
//     * @return ServiceUrgence[] Returns an array of ServiceUrgence objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ServiceUrgence
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
