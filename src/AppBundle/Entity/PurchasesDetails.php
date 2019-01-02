<?php

namespace AppBundle\Entity;

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
     * @var int
     *
     * @ORM\Column(name="tyreId", type="integer")
     */
    private $tyreId;

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
     * @param integer $purchaseId
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
     * Set tyreId
     *
     * @param integer $tyreId
     *
     * @return PurchasesDetails
     */
    public function setTyreId($tyreId)
    {
        $this->tyreId = $tyreId;

        return $this;
    }

    /**
     * Get tyreId
     *
     * @return int
     */
    public function getTyreId()
    {
        return $this->tyreId;
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
}

