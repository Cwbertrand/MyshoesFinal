<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function searchwithMen($search): array
    {
        $query = $this->createQueryBuilder('p')
            ->select('c', 'p', 'g')
            ->join('p.category', 'c')
            ->join('p.gendershoes', 'g');

            //It searches the checkboxes.
            if (!empty($search->categorycheckbox)) {
                $query = 
                    $query->andWhere('c.id IN (:category)')
                    ->andWhere('g.id IN (:genershoes)')
                    ->setParameter('genershoes', 1)
                    ->setParameter('category', $search->categorycheckbox);
            }

            return $query->getQuery()->getResult();
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function searchwithWomen($search): array
    {
        $query = $this->createQueryBuilder('p')
            ->select('c', 'p', 'g')
            ->join('p.category', 'c')
            ->join('p.gendershoes', 'g');

            //It searches the checkboxes.
            if (!empty($search->categorycheckbox)) {
                $query = 
                    $query->andWhere('c.id IN (:category)')
                    ->andWhere('g.id IN (:genershoes)')
                    ->setParameter('genershoes', 3)
                    ->setParameter('category', $search->categorycheckbox);
            }

            return $query->getQuery()->getResult();
    }


//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
