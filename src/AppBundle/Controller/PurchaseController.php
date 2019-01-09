<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Purchase;
use AppBundle\Service\Purchase\PurchaseServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PurchaseController
 * @package AppBundle\Controller
 * @Route("/purchase")
 */
class PurchaseController extends Controller
{
    /**
     * @var PurchaseServiceInterface
     */
    private $purchaseService;

    public function __construct(PurchaseServiceInterface $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    /**
     * @Route("/all", name="purchase_all")
     */
    public function showAllAction()
    {
        $purchases = $this->purchaseService->findAll();
        $totalSum=0;
        /** @var Purchase $purchase */
        foreach ($purchases as $purchase){
            $totalSum+=$purchase->getTotalSum();
        }
        $totalTyres=0;
        foreach ($purchases as $purchase){
            $totalTyres+=$purchase->getTotalTyres();
        }
        return $this->render('admin/purchases.html.twig',
            ['purchases'=>$purchases,
                'totalSum'=>$totalSum,
                'totalTyres'=>$totalTyres]);
    }
}
