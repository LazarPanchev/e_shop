<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 20.12.2018 г.
 * Time: 11:20
 */

namespace AppBundle\Service\Tyre;


use AppBundle\Entity\Tyre;
use AppBundle\Repository\TyreRepository;

class TyreService implements TyreServiceInterface
{
    /**
     * @var TyreRepository
     */
    private $tyreRepository;

    public function __construct(TyreRepository $tyreRepository)
    {
        $this->tyreRepository = $tyreRepository;
    }

    public function findAll()
    {
        return $this->tyreRepository->findAll();
    }

    /**
     * @param int $id
     * @return Tyre
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function findOne(int $id)
    {
        /** @var Tyre $tyre */
        $tyre = $this
            ->tyreRepository
            ->find($id);

        if(null === $tyre){
            return null;
        }

        $tyre->increaseCount();
        $this->tyreRepository->save($tyre);
        return $tyre;
    }

    /**
     * @param Tyre $tyre
     * @param string $fileName
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(Tyre $tyre, string $fileName)
    {
        $tyre->setImage($fileName);
        $tyre->setViewCount(0);
        $this->tyreRepository->save($tyre);
    }

    /**
     * @param Tyre $tyre
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Tyre $tyre){
       $this->tyreRepository->remove($tyre);
    }
}