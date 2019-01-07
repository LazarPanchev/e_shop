<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 31.12.2018 г.
 * Time: 10:58
 */

namespace AppBundle\Service\Purchase;


use AppBundle\Entity\PurchasesDetails;
use AppBundle\Entity\User;
use AppBundle\Repository\PurchaseRepository;
use AppBundle\Repository\PurchasesDetailsRepository;

class PurchaseService implements PurchaseServiceInterface
{
    /**
     * @var PurchasesDetailsRepository
     */
    private $purchasesDetailsRepository;

    /**
     * @var PurchaseRepository
     */
    private $purchaseRepository;

    public function __construct(PurchasesDetailsRepository $purchasesDetailsRepository,
                                PurchaseRepository $purchaseRepository)
    {
        $this->purchasesDetailsRepository = $purchasesDetailsRepository;
        $this->purchaseRepository = $purchaseRepository;
    }

    /**
     * @param PurchasesDetails $purchasesDetails
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function savePurchaseDetails(PurchasesDetails $purchasesDetails)
    {
        return $this->purchasesDetailsRepository->save($purchasesDetails);

    }

    public function findPurchaseDetailsByCartId($cartId)
    {
        $purchaseDetails = $this->purchasesDetailsRepository->findByCartId($cartId);
        return $purchaseDetails;
    }

    /**
     * @param $purchase
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function savePurchase($purchase)
    {
        return $this->purchaseRepository->save($purchase);
    }

    public function findPurchaseDetailByTyreId($tyreId){
        try{
            $tyre = $this->purchasesDetailsRepository->findByTyreId($tyreId);
        }catch (\Exception $exception){
            return null;
        }
        return $tyre;
    }

    public function findPurchaseDetailById($purchaseDetailsId)
    {
        return $this->purchasesDetailsRepository->find($purchaseDetailsId);
    }

    /**
     * @param $purchaseDetails
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removePurchaseDetail($purchaseDetails)
    {
        return $this->purchasesDetailsRepository->delete($purchaseDetails);
    }

    /**
     * @param $purchaseDetails
     * @param $quantitiesArr
     * @return bool|float|int
     */
    public function makePurchase($purchaseDetails,$quantitiesArr)
    {
        $index = 'quantity';
        $totalPurchaseSum = 0;

        for ($i = 0; $i < count($purchaseDetails); $i++) {
            $currentQuantity = intval($quantitiesArr[$index . ($i + 1)]);
            if($quantitiesArr[$index . ($i + 1)]===''){
               return false;
            }
            $currentPrice = $currentQuantity * $purchaseDetails[$i]->getTyre()->getPrice();
            $totalPurchaseSum += $currentPrice;
        }
        return $totalPurchaseSum;
    }

    /**
     * @param $purchaseDetails
     * @param $purchase
     * @param $quantitiesArr
     * @param $currentUser
     * @param $totalPurchaseSum
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function finalizePurchase($purchaseDetails,$purchase,$quantitiesArr,$currentUser, $totalPurchaseSum)
    {
        $index='quantity';
        for ($i = 0; $i < count($purchaseDetails); $i++) {
            /** @var PurchasesDetails $currentPurchase */
            $currentPurchase = $purchaseDetails[$i];
            $currentPurchase->setPurchaseId($purchase);
            $quantity = intval($quantitiesArr[$index . ($i + 1)]);
            $currentPurchase->setQuantity($quantity);
            $totalPrice = $quantity * $currentPurchase->getTyre()->getPrice();
            $currentPurchase->setPrice($totalPrice);
            $currentPurchase->setStatus(1);
            $this->savePurchaseDetails($currentPurchase);
        }
        $userMoney = floatval($currentUser->getMoney());
        $currentUser->setMoney($userMoney - $totalPurchaseSum);
    }
}