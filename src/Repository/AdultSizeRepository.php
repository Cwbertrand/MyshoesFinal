<?php

namespace App\Repository;

use App\Entity\AdultSize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AdultSize>
 *
 * @method AdultSize|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdultSize|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdultSize[]    findAll()
 * @method AdultSize[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdultSizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdultSize::class);
    }

    public function save(AdultSize $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AdultSize $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // /**
    //  * @return AdultSize[] Returns an array of AdultSize objects
    //  */
    // public function shoesSize($id): array
    // {
    //     return $this->createQueryBuilder('a')
    //         ->addSelect('p')
    //         ->leftJoin('')
    //         ->andWhere('a.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('a.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult();
    // }

//    /**
//     * @return AdultSize[] Returns an array of AdultSize objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AdultSize
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
