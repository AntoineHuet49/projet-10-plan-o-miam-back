<?php

namespace App\Repository;

use App\Entity\Lunchs;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Lunchs>
 *
 * @method Lunchs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lunchs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lunchs[]    findAll()
 * @method Lunchs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LunchsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lunchs::class);
    }

    public function add(Lunchs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Lunchs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Lunchs[] Returns an array of Lunchs objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Lunchs
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findByDate($monday, $sunday, $group)
    {
        return $this->createQueryBuilder('l')
            ->where('l.date BETWEEN :monday AND :sunday')
            ->setParameter('monday', $monday)
            ->setParameter('sunday', $sunday)
            ->innerJoin('l.groups', 'g')
            ->andWhere('g.id = :id')
            ->setParameter('id', $group)
            ->orderBy('l.date', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
