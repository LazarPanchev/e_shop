<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;

/**
 * Cart
 *
 * @ORM\Table(name="carts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CartRepository")
 */
class Cart
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
     * @var ArrayCollection|PurchasesDetails[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PurchasesDetails", mappedBy="cart")
     */
    private $purchase_details;


    /**
     * @var User
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function __construct()
    {
        $this->purchase_details= new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return PurchasesDetails[]|ArrayCollection
     */
    public function getPurchaseDetails()
    {
        return $this->purchase_details;
    }

    /**
     * @param PurchasesDetails[]|ArrayCollection $purchase_details
     */
    public function setPurchaseDetails($purchase_details)
    {
        $this->purchase_details = $purchase_details;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Cart
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }


//    /**
//     * @param Tyre $tyre
//     * @return Cart
//     */
//    public function addTyre(Tyre $tyre)
//    {
//        $tyre->setDateAdded(new \DateTime('now'));
//        $this->tyres[] = $tyre;
//
//        return $this;
//    }

    public function isTyreInCart($tyreId){
//        foreach ($this->purchase_details as $purchase_detail){
//            if ($purchase_detail->->getId() === $tyreId){
//                return true;
//            }
//        }
//        return false;
    }


}

