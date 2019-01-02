<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 29.12.2018 г.
 * Time: 16:57
 */

namespace AppBundle\Service\Cart;


use AppBundle\Entity\Cart;
use AppBundle\Entity\Tyre;
use AppBundle\Repository\CartRepository;
use AppBundle\Repository\TyreRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class CartService implements CartServiceInterface
{
    /**
     * @var CartRepository
     */
    private $cartRepository;

    /**
     * @var TyreRepository
     */
    private $tyreRepository;

    public function __construct(CartRepository $cartRepository, TyreRepository $tyreRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->tyreRepository = $tyreRepository;
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function findCartByUserId(int $userId)
    {

        $cart = $this
            ->cartRepository
            ->findBy(['userId' => $userId]);

        if (count($cart) === 0) {
            $cart = new Cart();
        }

        return ($cart[0]);
    }

    /**
     * @param Tyre $tyre
     * @param Cart $cart
     * @return bool
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addToCart($tyre, $cart)
    {
        if ($cart->isTyreInCart($tyre->getId())) {
            return false;
        }

        $cart->addTyre($tyre);
        $this->cartRepository
            ->save($cart);
        return true;
    }

    /**
     * @param $tyreId
     * @param $cartId
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeFromCart($tyreId, $cartId)
    {
//        /** @var Tyre[] $tyres */
//        $tyres = $this
//            ->cartRepository
//            ->removeTyreFromCart($tyreId,$cartId);
//        /** @var Cart $cart */
//        $cart=$this->cartRepository->find($cartId);
//
//      /**
//       * @var Tyre $tyre
//       */
//        foreach ($tyres as $key=>$tyre){
//            if($tyre->getId()===intval($tyreId)){
//                unset($tyres[$key]);
//            }
//        }
//
//        $cart->setTyres($tyres);
//        $this->cartRepository->save($cart);
        $result= $this
            ->cartRepository
            ->removeTyreFromCart($tyreId,$cartId);
    }
}