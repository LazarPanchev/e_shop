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
     * @var ArrayCollection|Tyre[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Tyre", inversedBy="carts")
     * @ORM\JoinTable(name="carts_tyres",
     *     joinColumns={@ORM\JoinColumn(name="cart_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="tyre", referencedColumnName="id")}
     *     )
     */
    private $tyres;


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="cartId")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;



    public function __construct()
    {
        $this->tyres= new ArrayCollection();
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Cart
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return Tyre[]|ArrayCollection
     */
    public function getTyres()
    {
        return $this->tyres;
    }

    /**
     * @param ArrayCollection|Tyre[]
     * @return Cart
     */
    public function setTyres($tyres){
        foreach ($tyres as $tyre){
            $this->tyres[]=$tyre;
        }
        return $this;
    }


    /**
     * @param Tyre $tyre
     * @return Cart
     */
    public function addTyre(Tyre $tyre)
    {
        $tyre->setDateAdded(new \DateTime('now'));
        $this->tyres[] = $tyre;

        return $this;
    }

    public function isTyreInCart($tyreId){
        foreach ($this->tyres as $tyre){
            if ($tyre->getId() === $tyreId){
                return true;
            }
        }
        return false;
    }

}

