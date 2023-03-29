<?php

namespace App\Repository;

use App\Classe\Search;
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
     * Requête permettant de récupérer les produits en fonction de la recherche du User
     */
    public function findWithSearch(Search $search){
        $query = $this
            ->createQueryBuilder('p')
            ->select('c','p','b','s')
            ->join('p.categoryVO','c')
            ->join('p.brandVO','b')
            ->join('p.subCategoryVO','s');

        if (!empty($search->categoryVOs)){
            $query = $query
                -> andWhere('c.id IN (:categoryVO)')
                ->setParameter('categoryVO', $search->categoryVOs);
        }
        
        if (!empty($search->subCategoryVOs)){
            $query = $query
                -> andWhere('s.id IN (:subCategoryVO)')
                ->setParameter('subCategoryVO', $search->subCategoryVOs);
        }

        if (!empty($search->string)){
            $query = $query
                -> andWhere('p.designation LIKE :string')
                ->setParameter('string', "%{$search->string}%");
        }

        if (!empty($search->brandVOs)){
            $query = $query
                -> andWhere('b.id IN (:brandVO)')
                ->setParameter('brandVO', $search->brandVOs);
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
