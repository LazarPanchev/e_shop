<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PurchasesDetails
 *
 * @ORM\Table(name="purchases_details")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PurchasesDetailsRepository")
 */
class PurchasesDetails
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Purchase", inversedBy="purchasesDetails")
     * @ORM\JoinColumn(name="purchase_id", referencedColumnName="id")
     */
    private $purchaseId;

    /**
     * @var Tyre
     *@ORM\ManyToOne(targetEntity="AppBundle\Entity\Tyre")
     * @ORM\JoinColumn(name="tyre", referencedColumnName="id")
     */
    private $tyre;

    /**
     * @var int
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var string
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @var Cart
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cart", inversedBy="purchase_details")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     */
    private $cart;

    /**
     * @var boolean
     * @ORM\Column(name="status", type="smallint", nullable=false)
     */
    private $status;

    public function __construct()
    {
        $this->quantity=1;
        $this->price=1;
        $this->status=0;
    }


    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set purchaseId
     *
     * @param integer
     *
     * @return PurchasesDetails
     */
    public function setPurchaseId($purchaseId)
    {
        $this->purchaseId = $purchaseId;

        return $this;
    }

    /**
     * Get purchaseId
     *
     * @return int
     */
    public function getPurchaseId()
    {
        return $this->purchaseId;
    }

    /**
     * @return Tyre
     */
    public function getTyre()
    {
        return $this->tyre;
    }

    /**
     * @param Tyre $tyre
     * @return PurchasesDetails
     */
    public function setTyre(Tyre $tyre)
    {
        $this->tyre = $tyre;
        return $this;
    }



    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return PurchasesDetails
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return PurchasesDetails
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return Cart
     */
    public function getCart(): Cart
    {
        return $this->cart;
    }

    /**
     * @param Cart $cart
     */
    public function setCart(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return bool
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function __toString()
    {
        $printResult = sprintf("Purchase quantity: $this->quantity pc. On price: $this->price" . PHP_EOL) ;
        return $printResult;
    }

}

