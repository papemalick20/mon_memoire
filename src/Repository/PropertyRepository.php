<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Migrations\Query\Query;
//use Doctrine\ORM\Query;
//use Doctrine\ORM\Query;
//use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }
    /**
     * @return property[]
     */
     public function findAllVisibleQuery(PropertySearch $search)
     {
         $query= $this->findVisibleQuery();
          if($search->getMaxprice()){
              $query = $query
              ->andWhere('p.price <= :maxprice')
              ->setParameter('maxprice', $search->getMaxprice());
          }

          $query= $this->findVisibleQuery();
          if($search->getMinsurface()){
              $query = $query
              ->andWhere('p.surface >= :minsurface')
              ->setParameter('minsurface', $search->getMinsurface());
          }
          if($search->getOptions()->count()>0){
              $k=0;
              foreach($search->getOptions() as $option){
                  $k++;
                  $query = $query
                  ->andWhere(":options$k MEMBER OF p.options")
                  ->setParameter("options$k", $option);
              }
          }
         return $query->getQuery()
                      
                 ->getResult();
     }
       /**
        * @return Property[]
        */


        public function findLatest(): array
        {
            return $this->findVisibleQuery()
                ->setMaxResults(4)
                ->getQuery()
                ->getResult();
               
        }
     /**
      * @return QueryBuilder
      */
     private function findVisibleQuery()
     {
         return $this->createQueryBuilder('p')
        ->where('p.sold=false');
        
     }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
