<?php

namespace App\Repository;

use App\Entity\DepotDeGarantie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DepotDeGarantie>
 *
 * @method DepotDeGarantie|null find($id, $lockMode = null, $lockVersion = null)
 * @method DepotDeGarantie|null findOneBy(array $criteria, array $orderBy = null)
 * @method DepotDeGarantie[]    findAll()
 * @method DepotDeGarantie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepotDeGarantieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepotDeGarantie::class);
    }

    public function save(DepotDeGarantie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DepotDeGarantie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DepotDeGarantie[] Returns an array of DepotDeGarantie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DepotDeGarantie
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
