<?php

namespace App\Repository;


/**
 * This custom Doctrine repository contains some methods which are useful when
 * querying for restaurants information.
 *
 */
class RestaurantRepository
{

    public function findAll(int $page = 1, Tag $tag = null): Paginator
    {

        $queryBuilder = $this->createQueryBuilder('p');

        $result = $queryBuilder
            ->orderBy('p.name', 'DESC')
            ->getQuery()
            ->getResult()
        ;

        return $result;
    }

    public function findOnById(int $id )
    {

        $queryBuilder = $this->createQueryBuilder('p');

        $result = $queryBuilder
            ->Where('p.title ='.$id)
            ->orderBy('p.name', 'DESC')
            ->getQuery()
            ->getResult()
        ;

        return $result;
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


}