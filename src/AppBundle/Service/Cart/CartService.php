<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 29.12.2018 г.
 * Time: 16:57
 */

namespace AppBundle\Service\Cart;


use AppBundle\Entity\Cart;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\PurchasesDetails;
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
    public function findCartWithTyresByUserId(int $userId)
    {
        /** @var Cart $cart */
        $cart=$this
            ->cartRepository
            ->findOneBy(['userId'=>$userId]);
        if (null === $cart) {
            $cart = new Cart();
        }else{
            $tyres=$this->tyreRepository->findTyresInCart($cart->getId());
            $cart->setTyres($tyres);
        }

        return $cart;
    }


    public function findCartByCartId($cartId)
    {
        return $this->cartRepository->find($cartId);
    }

    public function findCartByUserId($userId)
    {
//        $cart = $this->cartRepository->findBy(['user'=>$userId]);
        $cart = $this->cartRepository->findCartWithPurchasesDetails($userId);
        if(count($cart) === 0){
            return null;
        }
        return $cart[0];

    }
}