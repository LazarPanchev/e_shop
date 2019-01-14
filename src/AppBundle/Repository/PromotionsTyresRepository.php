<?php

namespace AppBundle\Repository;
use AppBundle\Entity\PromotionsTyres;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

/**
 * PromotionsTyresRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PromotionsTyresRepository extends EntityRepository
{
    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em,
            new Mapping\ClassMetadata(PromotionsTyres::class));
    }

    public function save($promotionsTyre)
    {
        $this->_em->persist($promotionsTyre);
        $this->_em->flush();
    }
}