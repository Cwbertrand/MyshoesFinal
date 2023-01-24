<?php

namespace App\Repository;

use App\Entity\Remarks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Remarks>
 *
 * @method Remarks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Remarks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Remarks[]    findAll()
 * @method Remarks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemarksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Remarks::class);
    }

    public function save(Remarks $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Remarks $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Remarks[] Returns an array of Remarks objects
     */
    public function findProductId($productId): array
    {
        return $this->createQueryBuilder('r')
            ->select('pr', 'r')
            ->join('r.product', 'pr')
            ->andWhere('r.product = :productId')
            ->setParameter('productId', $productId)
            ->orderBy('r.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    //total reviews
    public function sumProductReview($productId): array
    {
        return $this->createQueryBuilder('r')
            ->join('r.product', 'pr')
            ->andWhere('r.product = :productId')
            ->setParameter('productId', $productId)
            ->select('SUM(r.rating) as note')
            ->orderBy('r.id', 'DESC')
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return Remarks[] Returns an array of Remarks objects
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

//    public function findOneBySomeField($value): ?Remarks
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
