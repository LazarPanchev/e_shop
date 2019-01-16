<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 12.1.2019 г.
 * Time: 19:50
 */

namespace AppBundle\Service\Promotion;

use AppBundle\Entity\Promotion;
use AppBundle\Entity\Tyre;

interface PromotionServiceInterface
{
    public function addPromotion(Promotion $promotion, $user);

    public function findPromotionById($promotionId);

    public function addTyreToPromotion($promotion,$tyreId);

    public function findTyreInPromotion($id);

    public function setPromotions($tyres);

    public function setPromotionsOneTyre($tyre);

    public function findPromotionsTyresByTyreId($tyreId);

    public function savePromotionsTyre($promotionsTyre);

    public function checkPromotionsAreActive($promotions);
}