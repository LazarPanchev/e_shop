<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 29.12.2018 г.
 * Time: 16:57
 */

namespace AppBundle\Service\Cart;


use AppBundle\Entity\Cart;

interface CartServiceInterface
{
    public function findCartByUserId(int $userId);

    public function addToCart($tyre, $cart);

    public function removeFromCart($tyreId,$cartId);
}