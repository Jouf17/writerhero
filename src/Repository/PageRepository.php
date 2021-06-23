<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\Page;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Page|null find($id, $lockMode = null, $lockVersion = null)
 * @method Page|null findOneBy(array $criteria, array $orderBy = null)
 * @method Page[]    findAll()
 * @method Page[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Page::class);
    }

    public function findOneByNumber(int $numPage, Book $book)
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.number = :numPage')
            ->andWhere('p.book = :book')
            ->setParameter('numPage', $numPage)
            ->setParameter('book', $book)
            ->getQuery()
            ->getSingleResult();
    }

    public function countPagesByBook(Book $book)
    {
        return $this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->where('p.book = :book')
            ->setParameter('book', $book)
            ->getQuery()
            ->getSingleScalarResult();
    }

    // /**
    //  * @return Page[] Returns an array of Page objects
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
    public function findOneBySomeField($value): ?Page
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
