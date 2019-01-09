<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 31.12.2018 г.
 * Time: 10:57
 */

namespace AppBundle\Service\Purchase;


use AppBundle\Entity\PurchasesDetails;

interface PurchaseServiceInterface
{
    public function savePurchaseDetails(PurchasesDetails $purchasesDetails);

    public function findPurchaseDetailsByCartId($cartId);

    public function savePurchase($purchase);

    public function findPurchaseDetailByTyreId($tyreId, $userId);

    public function findPurchaseDetailById($purchaseDetailsId);

    public function removePurchaseDetail($purchaseDetails);

    public function makePurchase($purchaseDetails,$quantitiesArr);

    public function finalizePurchase($purchaseDetails,$purchase,$quantitiesArr, $currentUser,$totalPurchaseSum);

    public function findAll();

    public function findPurchaseByUser($userId);

}