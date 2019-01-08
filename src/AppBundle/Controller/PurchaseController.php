<?php

namespace AppBundle\Controller;

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
        return $this->render('admin/purchases.html.twig',
            ['purchases'=>$purchases]);
    }
}
