<?php

namespace App\Repository;

use App\Entity\Restaurante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Restaurante>
 *
 * @method Restaurante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurante[]    findAll()
 * @method Restaurante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestauranteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurante::class);
    }

    public function findBestRanked()
    {

        $queryBuilder = $this->createQueryBuilder('p');

        $result = $queryBuilder
            ->orderBy('p.ranking', 'DESC')
            ->getQuery()
            ->getResult()
            ->setMaxResults(1);
        ;

        return $result;
    }

    public function findOneById(int $id )
    {

        $queryBuilder = $this->createQueryBuilder('p');

        $result = $queryBuilder
            ->where('p.id ='.$id)
            ->getQuery()
            ->getResult()
        ;

        return $result;
    }
}
