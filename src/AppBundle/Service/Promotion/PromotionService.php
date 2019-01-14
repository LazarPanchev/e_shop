<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 12.1.2019 г.
 * Time: 19:51
 */

namespace AppBundle\Service\Promotion;

use AppBundle\Entity\Promotion;
use AppBundle\Entity\PromotionsTyres;
use AppBundle\Repository\PromotionRepository;
use AppBundle\Repository\PromotionsTyresRepository;
use AppBundle\Repository\TyreRepository;


class PromotionService implements PromotionServiceInterface
{
    /**
     * @var PromotionRepository
     */
    private $promotionRepository;

    /**
     * @var TyreRepository
     */
    private $tyreRepository;

    /**
     * @var PromotionsTyresRepository
     */
    private $promotionsTyresRepository;


    public function __construct(PromotionRepository $promotionRepository,
                                TyreRepository $tyreRepository,
                                PromotionsTyresRepository $promotionsTyresRepository)
    {
        $this->promotionRepository = $promotionRepository;
        $this->tyreRepository = $tyreRepository;
        $this->promotionsTyresRepository = $promotionsTyresRepository;
    }

    /**
     * @param Promotion $promotion
     * @param $userId
     * @return bool
     */
    public function addPromotion(Promotion $promotion, $userId)
    {
        $validFrom = $promotion->getValidFrom();
        $validTo = $promotion->getValidTo();
        $message = '';
        $currentPromotion = $this
            ->promotionRepository
            ->findBy(['name' => $promotion->getName()]);
        if ($currentPromotion) {
            $message = "Promotion name already exist. Please choose another one!";
            return $message;
        }

        if ($validFrom > $validTo || $validFrom == $validTo) {
            $message = "Valid from date must be before valid to date!";
            return $message;
        }
        $promotion->setSellerId($userId);
        $this->promotionRepository->save($promotion);

        return $message;
    }
//
//    private function addTyresToPromotion($promotionId, $userId)
//    {
//        /** @var Tyre[] $myTyres */
//        $myTyres = $this->tyreRepository->findBy(['seller' => $userId]);
//        $currentPromotion = $this->promotionRepository->find($promotionId);
//        foreach ($myTyres as $myTyre) {
//            /** @var Promotion $currentPromotion */
//            $promotionsTyre = new PromotionsTyres();
//            $promotionsTyre->setPromotionId($promotionId);
//            $promotionsTyre->setTyreId($myTyre->getId());
//            $currentPromotion->addPromotionsTyre($promotionsTyre);
//        }
//        $this->promotionRepository->save($currentPromotion);
//    }

    public function findPromotionById($promotionId)
    {
        return $this->promotionRepository->find($promotionId);

    }

    /**
     * @param $promotion
     * @param $tyreId
     * @return bool
     */
    public function addTyreToPromotion($promotion, $tyreId)
    {
        $existTyre=$this->tyreRepository->find($tyreId);
        if(null===$existTyre){
            return false;
        }

        $promotionsTyre= new PromotionsTyres();
        $promotionsTyre
            ->setPromotionId($promotion)
            ->setTyreId($tyreId);

        $this->promotionsTyresRepository
            ->save($promotionsTyre);
        return true;
    }

    public function findPromotionsBySellerId($sellerId)
    {
        $promotions= $this->promotionRepository->findBy(['sellerId'=>$sellerId]);
        return $promotions;
    }
}