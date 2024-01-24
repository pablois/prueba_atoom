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

    public function update(int $id, string $nombre,  string $website, string $body, int $ranking)
    {
        $queryBuilder = $this->createQueryBuilder('p');

        $query = $queryBuilder->update()
            ->set('p.nombre', ':nombre')
            ->set('p.website', ':website')
            ->set('p.ranking', ':ranking')
            ->set('p.body', ':body')
            ->where('p.id = :editId')
            ->setParameter('ranking', $ranking)
            ->setParameter('website', $website)
            ->setParameter('nombre', $nombre)
            ->setParameter('body', $body)
            ->setParameter('editId', $id)
            ->getQuery();
        $result = $query->execute();
    }

    public function delete(int $id)
    {

        $queryBuilder = $this->createQueryBuilder('p');

        $query = $queryBuilder->delete()
            ->where('p.id = :editId')
            ->setParameter('editId', $id)
            ->getQuery();
        return $query->execute();
    }

    public function findBestRanked()
    {

        $queryBuilder = $this->createQueryBuilder('p');

        $result = $queryBuilder
            ->orderBy('p.ranking', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()

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
