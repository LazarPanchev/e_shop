<?php

namespace AppBundle\Repository;


use AppBundle\Entity\Tyre;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SearchRepository extends EntityRepository
{
    /**
     * UserRepository constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em,
            new Mapping\ClassMetadata(Tyre::class));
    }

    public function findBySize($width,$height,$diameter){
        $query = $this->createQueryBuilder('t')
            ->select('tyre')
            ->from('AppBundle:Tyre', 'tyre')
            ->andWhere('tyre.width = :width')
            ->setParameter('width',$width)
            ->andWhere('tyre.height = :height')
            ->setParameter('height',$height)
            ->andWhere('tyre.diameter = :diameter')
            ->setParameter('diameter',$diameter)
           // ->orderBy('comment.id', 'DESC')
            ->getQuery();

        return $query->getResult();

    }

    public function findByBrand($searchedWord){
        $query = $this->createQueryBuilder('t')
            ->select('tyre')
            ->from('AppBundle:Tyre', 'tyre')
            ->where('tyre.make LIKE :searchedWord')
            ->setParameter('searchedWord',"%$searchedWord%")
            // ->orderBy('comment.id', 'DESC')
            ->getQuery();

        return $query->getResult();

    }
}
