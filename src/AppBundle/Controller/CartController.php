<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cart;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\Tyre;
use AppBundle\Form\PurchaseType;
use AppBundle\Service\Cart\CartServiceInterface;
use AppBundle\Service\Purchase\PurchaseServiceInterface;
use AppBundle\Service\Tyre\TyreServiceInterface;
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
     * @var TyreServiceInterface
     */
    private $tyreService;


    public function __construct(CartServiceInterface $cartService,
                                TyreServiceInterface $tyreService)
    {
        $this->cartService = $cartService;
        $this->tyreService = $tyreService;
    }

    /**
     * @Route("/show", name="cart_show")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showCartAction(Request $request)
    {
        $currentUser = $this->getUser();
        if (null === $currentUser) {
            $this->addFlash('error', 'You must Register or Log in to use shopping cart');
            return $this->redirectToRoute('homepage');
        }

        /** @var Cart $cart */
        $cart = $this
            ->cartService
            ->findCartByUserId($currentUser->getId());
        $tyres = $this
            ->tyreService
            ->findTyresByCartId($cart->getId());

        $purchase = new Purchase();
        $form = $this->createForm(PurchaseType::class, $purchase);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            dump('submitted form');
            exit();
        }

        return $this->render("user/cart.html.twig",
            ['tyres' => $tyres,
                'form'=>$form->createView()]);
    }

    /**
     * @Route("/add/{tyreId}", name="cart_add")
     * @param $tyreId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addToCartAction($tyreId)
    {
        /** @var Tyre $tyre */
        $tyre = $this
            ->tyreService
            ->findOne($tyreId);
        if (null === $tyre) {
            $this->addFlash('error', 'Not selected product. Please choose one!');
            return $this->redirectToRoute('tyres_view_all');
        }
        $cart = $this->cartService->findCartByUserId($this->getUser()->getId());;
        if (!$this->cartService->addToCart($tyre, $cart)) {
            $this->addFlash('error', 'The tyre already exist in your shopping cart!');
            return $this->redirectToRoute('tyres_view_one', ['id' => $tyreId]);
        }
        return $this->redirectToRoute('cart_show');
    }

    /**
     * @Route("/delete/{tyreId}", name="cart_delete")
     * @param $tyreId
     */
    public function removeFromCartAction($tyreId){

//        /** @var Tyre $tyre */
//        $tyre = $this
//            ->tyreService
//            ->findOne($tyreId);
        /** @var Cart $cart */
        $cart = $this->cartService->findCartByUserId($this->getUser()->getId());
        $cartId=$cart->getId();
        $this
            ->cartService
            ->removeFromCart($tyreId,$cartId);

        return $this->redirectToRoute('cart_show');

//        $cart = $this
//            ->checkForCurrentUser();
//        $cart->addPurchase()
//        dump($cart);
//        exit();




//        $purchase=new Purchase();
//        $purchaseDetails= new PurchasesDetails();
//        $purchaseDetails->setPurchaseId($purchase->getId())->
//        $purchase->setUserId($currentUserId)
//            ->setCartId($cart->getId())
//            ->addPurchasesDetails()

//
//        $cart->addTyre($tyre);
//        $this->cartService->saveCart($cart);


    }

}
