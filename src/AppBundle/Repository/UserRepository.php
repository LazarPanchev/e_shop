<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    /**
     * UserRepository constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em,
            new Mapping\ClassMetadata(User::class));
    }

    /**
     * @param User $user
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(User $user){
        $this->_em->persist($user);
        $this->_em->flush();
    }

}
