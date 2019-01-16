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
use AppBundle\Entity\Tyre;
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
     * @param $user
     * @return bool
     */
    public function addPromotion(Promotion $promotion, $user)
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
        $promotion->setSeller($user);

        $this->promotionRepository->save($promotion);

        return $message;
    }

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
        $message = '';
        $existTyre = $this->tyreRepository->find($tyreId);
        if (null === $existTyre) {
            $message = 'Tyre not exist';
        }
        /** @var Promotion $promotion */
        $existPromotionTyre = $this
            ->promotionsTyresRepository
            ->findBy(['tyreId' => $tyreId,
                'promotionId' => $promotion->getId()]);


        if ($existPromotionTyre) {
            $message = 'Tyre already exist in this promotion!';
        } else {
            $promotionsTyre = new PromotionsTyres();
            $tyrePrice = $existTyre->getPrice();
            $promotionPrice = $tyrePrice - (($tyrePrice * $promotion->getDiscount()) / 100);
            $promotionsTyre
                ->setPromotionId($promotion)
                ->setTyreId($tyreId)
                ->setPromotionPrice($promotionPrice);

            $this->promotionsTyresRepository
                ->save($promotionsTyre);
        }

        return $message;
    }

    /**
     * @param $sellerId
     * @return array
     */
    public function findPromotionsBySellerId($sellerId)
    {
        $promotions = $this->promotionRepository->findBy(['seller' => $sellerId]);
        return $promotions;
    }

    /**
     * @param $id
     * @return array|null
     */
    public function findTyreInPromotion($id)
    {
        $todayDate = new \DateTime('now');
        $tyreInPromotion = $this->promotionsTyresRepository->findPromotionByTyreIdAndDate($id, $todayDate);
        if ($tyreInPromotion === []) {
            return null;
        }

        return $tyreInPromotion;
    }

    public function setPromotions($tyres)
    {
        foreach ($tyres as $tyre) {
            $this->setPromotionsOneTyre($tyre);
        }
    }

    public function setPromotionsOneTyre($tyre)
    {
        /** @var Tyre $tyre */
        $promotions = $tyre->getSeller()->getPromotions();
        $promotionPrice = 0;
        $baseWeight = PHP_INT_MAX;
        foreach ($promotions as $promotion) {
            /** @var Promotion $promotion */
            if ($promotion->isTyreInPromotion($tyre->getId())) {
                if ($promotion->getWeight() < $baseWeight) {
                    $promotionPrice = $tyre->getPrice() - (($tyre->getPrice() * $promotion->getDiscount()) / 100);
                    $baseWeight = $promotion->getWeight();
                } elseif ($promotion->getWeight() == $baseWeight) {
                    $newPrice = $tyre->getPrice() - (($tyre->getPrice() * $promotion->getDiscount()) / 100);
                    if ($newPrice < $promotionPrice) {
                        $promotionPrice = $newPrice;
                    }
                }
            }
        }
        $tyre->setPromotionPrice($promotionPrice);
    }

    public function findPromotionsTyresByTyreId($tyreId)
    {
        return $this->promotionsTyresRepository->findBy(['tyreId' => $tyreId]);
    }

    public function savePromotionsTyre($promotionsTyre)
    {
        $this->promotionsTyresRepository->save($promotionsTyre);
    }

    public function checkPromotionsAreActive($promotions)
    {
        $activePromotions = [];
        $todayDate = new \DateTime('now');
        foreach ($promotions as $promotion) {
            /** @var Promotion $promotion */
            if ($promotion->getValidFrom() < $todayDate && $promotion->getValidTo() > $todayDate) {
                $activePromotions[] = $promotion;
            }
        }
        return $activePromotions;
    }
}