<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    //    /**
    //     * @return Author[] Returns an array of Author objects
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

    //    public function findOneBySomeField($value): ?Author
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findByDateOfBirth(array $dates = []): ORMQueryBuilder
    {
        $qb = $this->createQueryBuilder('a');
        
        if (\array_key_exists('start', $dates)) {
            $qb->andWhere('a.dateOfBirth >= :start')
                ->setParameter('start', new \DateTimeImmutable($dates['start']));
        }
        
        if (\array_key_exists('end', $dates)) {
            $qb->andWhere('a.dateOfBirth <= :end')
                ->setParameter('end', new \DateTimeImmutable($dates['end']));
        }
        
        return $qb;
    }
}
