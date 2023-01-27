<?php

namespace App\Repository;

use App\Entity\ShoesGender;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShoesGender>
 *
 * @method ShoesGender|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShoesGender|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShoesGender[]    findAll()
 * @method ShoesGender[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoesGenderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoesGender::class);
    }

    public function save(ShoesGender $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ShoesGender $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // /**
    //  * @return ShoesGender[] Returns an array of ShoesGender objects
    //  */
    // public function relatedProducts($id): array
    // {
    //     return $this->createQueryBuilder('s')
    //         ->addSelect('p')
    //         ->leftJoin('s.products', 'p')
    //         ->Where(':id MEMBER OF s.products')
    //         ->setParameter('id', $id)
    //         ->setMaxResults(3)
    //         ->getQuery()
    //         ->getResult();
    // }

//    /**
//     * @return ShoesGender[] Returns an array of ShoesGender objects
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

//    public function findOneBySomeField($value): ?ShoesGender
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
