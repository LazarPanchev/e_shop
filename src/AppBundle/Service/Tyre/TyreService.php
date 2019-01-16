<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 20.12.2018 г.
 * Time: 11:20
 */

namespace AppBundle\Service\Tyre;


use AppBundle\Entity\PromotionsTyres;
use AppBundle\Entity\Tyre;
use AppBundle\Repository\TyreRepository;
use AppBundle\Service\Promotion\PromotionServiceInterface;
use Doctrine\ORM\NoResultException;

class TyreService implements TyreServiceInterface
{
    /**
     * @var TyreRepository
     */
    private $tyreRepository;

    /**
     * @var PromotionServiceInterface
     */
    private $promotionService;


    public function __construct(TyreRepository $tyreRepository,
                                PromotionServiceInterface $promotionService)
    {
        $this->tyreRepository = $tyreRepository;
        $this->promotionService = $promotionService;
    }


    public function findAll()
    {
        return $this->tyreRepository->findAll();
    }

    public function findTyreByTyreId($tyreId)
    {
        return $this->tyreRepository->find($tyreId);
    }

    /**
     * @param int $id
     * @return Tyre
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOne(int $id)
    {
        try {
            $tyre = $this
                ->tyreRepository
                ->findTyreWithPromotions($id);
        } catch (NoResultException $exception) {
            return null;
        }
        return $tyre;
    }

    /**
     * @param Tyre $tyre
     * @param string $fileName
     */
    public function create(Tyre $tyre, string $fileName)
    {
        $tyre->setImage($fileName);
        $tyre->setViewCount(0);
        $this->saveTyre($tyre);
    }

    /**
     * @param Tyre $tyre
     */
    public function delete(Tyre $tyre)
    {
        return $this->tyreRepository->remove($tyre);
    }

    /**
     * @param $cartId
     * @return array
     */
    public function findTyresByCartId($cartId)
    {
        $tyres = $this
            ->tyreRepository
            ->findTyresInCart($cartId);
        return $tyres;
    }

    /**
     * @param Tyre $tyre
     * @param string $fileName
     */
    public function edit($tyre, $fileName)
    {
        $tyre->setImage($fileName);
        $this->promotionService->setPromotionsOneTyre($tyre);
        $this->saveTyre($tyre);
    }

    public function findAllTyresWithPromotions()
    {
        return $this->tyreRepository->findAllWithPromotions();
    }

    public function findTyresWithPromotionsByUserId($currentUserId)
    {
        return $this->tyreRepository->findAllWithPromotionsByUserId($currentUserId);
    }

    /**
     * @param $tyreId
     * @return null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneWithPromotionsAndComments($tyreId)
    {
        try {
            $tyre = $this->tyreRepository->findOneWithPromotionsAndComments($tyreId);
        } catch (NoResultException $exception) {
            return null;
        }
        return $tyre;
    }

    public function increaseViewCount($tyre)
    {
        /** @var $tyre Tyre */
        $tyre->increaseCount();
        $this->tyreRepository->save($tyre);
    }

    private function saveTyre(Tyre $tyre)
    {
        $promotionsTyres = $this->promotionService->findPromotionsTyresByTyreId($tyre->getId());
        /** @var PromotionsTyres $promotionsTyre */
        foreach ($promotionsTyres as $promotionsTyre) {
            $tyrePrice = $tyre->getPrice();
            $promotionPrice = $tyrePrice - (($tyrePrice * $promotionsTyre->getPromotionId()->getDiscount()) / 100);
            $promotionsTyre->setPromotionPrice($promotionPrice);
            $this->promotionService->savePromotionsTyre($promotionsTyre);
        }
        $this->tyreRepository->save($tyre);
    }

    public function setPromotionsToPurchaseDetails($purchaseDetails)
    {
        foreach ($purchaseDetails as $purchaseDetail){
            $this->promotionService->setPromotionsOneTyre($purchaseDetail->getTyre());
        }
    }
}