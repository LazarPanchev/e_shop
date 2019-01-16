<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cart;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\PurchasesDetails;
use AppBundle\Entity\Tyre;
use AppBundle\Entity\User;
use AppBundle\Form\PurchaseType;
use AppBundle\Service\Cart\CartServiceInterface;
use AppBundle\Service\Purchase\PurchaseServiceInterface;
use AppBundle\Service\Tyre\TyreServiceInterface;
use AppBundle\Service\User\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/cart")
 * Class UserController
 * @package AppBundle\Controller
 */
class CartController extends Controller
{
    /**
     * @var CartServiceInterface
     */
    private $cartService;
    /**
     * @var PurchaseServiceInterface
     */
    private $purchaseService;

    /**
     * @var TyreServiceInterface
     */
    private $tyreService;

    /**
     * @var UserServiceInterface
     */
    private $userService;


    public function __construct(CartServiceInterface $cartService,
                                PurchaseServiceInterface $purchaseService,
                                TyreServiceInterface $tyreService,
                                UserServiceInterface $userService)
    {
        $this->cartService = $cartService;
        $this->purchaseService = $purchaseService;
        $this->tyreService = $tyreService;
        $this->userService = $userService;
    }

    /**
     * @Route("/show", name="cart_show")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showCartAction(Request $request)
    {
        /** @var User $currentUser */
        $currentUser = $this->getUser();
        $this->checkForNull($currentUser);

        /** @var Cart $cart */
        $cart = $this
            ->cartService
            ->findCartByUserId($currentUser->getid());

        $purchaseDetails = $this
            ->purchaseService
            ->findPurchaseDetailsByCartId($cart->getId());
        $this->tyreService->setPromotionsToPurchaseDetails($purchaseDetails);
        $purchase = new Purchase();
        $form = $this->createForm(PurchaseType::class, $purchase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->handlePurchaseAction($request,$purchase,$currentUser,$purchaseDetails);
        }

        return $this->render("user/cart.html.twig",
            ['cart' => $cart,
                'purchaseDetails' => $purchaseDetails,
                'form' => $form->createView()]);
    }

    /**
     * @Route("/add/{tyreId}", name="cart_add")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @param $tyreId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addToCartAction($tyreId)
    {
        if (null === $tyreId) {
            $this->addFlash('error', 'Not selected product. Please choose one!');
            return $this->redirectToRoute('tyres_view_all');
        }

        /** @var Tyre $tyre */
        $tyre = $this->tyreService->findTyreByTyreId($tyreId);
        if($tyre->getQuantity()==0){
            $this->addFlash('error', 'Tyre out of stock. Please choose another one.');
            return $this->redirectToRoute('tyres_view_all');
        }
        $existPurchaseDetail = $this->purchaseService->findPurchaseDetailByTyreId($tyre->getId(),$this->getUser()->getId());
        if ($existPurchaseDetail) {
            $this->addFlash('error', 'Tyre already exist in your shopping cart!');
            return $this->redirectToRoute('tyres_view_all');
        }
        $purchaseDetails = new PurchasesDetails();
        $purchaseDetails->setTyre($tyre);
        $cart = $this->cartService->findCartByUserId($this->getUser()->getId());
        $purchaseDetails->setCart($cart);

        try {
            $this->purchaseService
                ->savePurchaseDetails($purchaseDetails);
        } catch (\Exception $exception) {
            $this->addFlash('error', 'Not selected item!');
            return $this->redirectToRoute('cart_show');
        }

        return $this->redirectToRoute('cart_show');
    }

    /**
     * @Route("/delete/{purchaseDetailsId}", name="cart_delete")
     * @param $purchaseDetailsId
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeFromCartAction($purchaseDetailsId)
    {
        $purchaseDetails = $this->purchaseService->findPurchaseDetailById($purchaseDetailsId);
        if (null === $purchaseDetails) {
            $this->addFlash('error', 'Not selected item to remove!');
            return $this->redirectToRoute('cart_show');
        }
        $this->purchaseService->removePurchaseDetail($purchaseDetails);
        return $this->redirectToRoute('cart_show');
    }


    /**
     * @param $data
     * @return bool|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function checkForNull($data)
    {
        if (null === $data) {
            $this->addFlash('error', 'You must Register or Log in to use shopping cart');
            return $this->redirectToRoute('homepage');
        }
        return true;
    }

    /**
     * @param $request
     * @param Purchase $purchase
     * @param User $currentUser
     * @param $purchaseDetails
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function handlePurchaseAction($request,Purchase $purchase,$currentUser, $purchaseDetails)
    {
        $quantitiesArr = $request->request->all()['cart'];


        $totalPurchaseSum=$this
            ->purchaseService
            ->makePurchase($purchaseDetails,$quantitiesArr);

        if(!$totalPurchaseSum){
            $this->addFlash('error', 'Please select tyre quantity');
            return $this->redirectToRoute('cart_show');
        }

        if ($totalPurchaseSum > floatval($currentUser->getMoney())) {
            $this->addFlash('error', 'Not enough money for this purchase. Please make a deposit!');
            return $this->redirectToRoute('cart_show');
        }

        $purchase->setUserId($currentUser);
        $this->purchaseService->savePurchase($purchase);


        $this->purchaseService
            ->finalizePurchase($purchaseDetails,$purchase,$quantitiesArr, $currentUser,$totalPurchaseSum);
        $this->userService
            ->save($currentUser);
        $this->addFlash('success', 'Successful purchase');
        return $this->redirectToRoute('homepage');
    }

}
