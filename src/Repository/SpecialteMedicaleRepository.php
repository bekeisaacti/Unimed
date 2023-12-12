<?php

namespace App\Repository;

use App\Entity\SpecialteMedicale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SpecialteMedicale>
 *
 * @method SpecialteMedicale|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpecialteMedicale|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpecialteMedicale[]    findAll()
 * @method SpecialteMedicale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialteMedicaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecialteMedicale::class);
    }

//    /**
//     * @return SpecialteMedicale[] Returns an array of SpecialteMedicale objects
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

//    public function findOneBySomeField($value): ?SpecialteMedicale
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
