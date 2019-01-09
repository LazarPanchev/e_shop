<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Purchase
 *
 * @ORM\Table(name="purchases")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PurchaseRepository")
 */
class Purchase
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="purchases")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @var \DateTime
     * @ORM\Column(name="createDate", type="datetime")
     */
    private $createDate;

    /**
     * @var string
     * @ORM\Column(name="deliveryAddress", type="string", length=255)
     * @Assert\NotBlank(message="You must enter a delivery address!")
     */
    private $deliveryAddress;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


    /**
     * @var ArrayCollection|PurchasesDetails[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PurchasesDetails", mappedBy="purchaseId")
     */
    private $purchasesDetails;


    public function __construct()
    {
        $this->createDate= new \DateTime('now');
        $this->purchasesDetails = new ArrayCollection();
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
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return Purchase
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set deliveryAddress
     *
     * @param string $deliveryAddress
     *
     * @return Purchase
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    /**
     * Get deliveryAddress
     *
     * @return string
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Purchase
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return PurchasesDetails[]|ArrayCollection
     */
    public function getPurchasesDetails()
    {
        return $this->purchasesDetails;
    }


    public function setPurchasesDetails($purchaseDetails){
        $this->purchasesDetails=$purchaseDetails;
    }

    /**
     * @param PurchasesDetails $purchasesDetails
     * @return Purchase
     */
    public function addPurchasesDetails(PurchasesDetails $purchasesDetails)
    {
        $this->purchasesDetails[] = $purchasesDetails;
        return $this;
    }

    /**
     * @return int|string
     */
    public function getTotalSum(){
        $totalSum=0;
        foreach ($this->purchasesDetails as $purchasesDetail){
            $totalSum+=$purchasesDetail->getPrice();
        }
        return $totalSum;
    }

    /**
     * @return int
     */
    public function getTotalTyres(){
        $totalTyres=0;
        foreach ($this->purchasesDetails as $purchasesDetail){
            $totalTyres+=$purchasesDetail->getQuantity();
        }
        return $totalTyres;
    }



}

