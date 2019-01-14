<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 12.1.2019 г.
 * Time: 19:50
 */

namespace AppBundle\Service\Promotion;
use AppBundle\Entity\Promotion;

interface PromotionServiceInterface
{
    public function addPromotion(Promotion $promotion, $userId);

    public function findPromotionById($promotionId);

    public function addTyreToPromotion($promotion,$tyreId);

    public function findPromotionsBySellerId($sellerId);

}