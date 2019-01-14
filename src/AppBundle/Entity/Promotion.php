<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Promotion
 *
 * @ORM\Table(name="promotions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PromotionRepository")
 */
class Promotion
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
     * @var string
     * @Assert\NotBlank(message="Choose a Promotion name")
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank(message="Choose Discount percent")
     * @Assert\Range(
     *      min = 1,
     *      max = 100,
     *      minMessage = "Discount percent must be at least {{ limit }} %",
     *      maxMessage = "Discount percent cannot be more than {{ limit }}%"
     * )
     * @ORM\Column(name="discount", type="integer")
     */
    private $discount;
    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Choose Valid From date")
     * @Assert\DateTime(format="Y-m-d",message="Not valid date")
     * @ORM\Column(name="validFrom", type="datetime")
     */
    private $validFrom;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Choose Valid To date")
     * @Assert\DateTime(format="Y-m-d", message="Not valid date")
     * @ORM\Column(name="validTo", type="datetime")
     */
    private $validTo;

    /**
     * @var int
     * @Assert\Range(
     *      min = 1,
     *      max = 5,
     *      minMessage = "Promotion Weight must be at least {{ limit }} points",
     *      maxMessage = "Promotion Weight cannot be more than {{ limit }} points"
     * )
     * @ORM\Column(name="weight", type="smallint")
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="promotions")
     * @ORM\JoinColumn(name="seller_id", referencedColumnName="id")
     */
    private $sellerId;

    /**
     * @var ArrayCollection|PromotionsTyres[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PromotionsTyres", mappedBy="promotionId")
     */
    private $promotionsTyres;


    public function __construct()
    {
            $this->promotionsTyres=new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Promotion
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set validFrom.
     *
     * @param \DateTime $validFrom
     *
     * @return Promotion
     */
    public function setValidFrom($validFrom)
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    /**
     * Get validFrom.
     *
     * @return \DateTime
     */
    public function getValidFrom()
    {
        return $this->validFrom;
    }

    /**
     * Set validTo.
     *
     * @param \DateTime $validTo
     *
     * @return Promotion
     */
    public function setValidTo($validTo)
    {
        $this->validTo = $validTo;

        return $this;
    }

    /**
     * Get validTo.
     *
     * @return \DateTime
     */
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * Set weight.
     *
     * @param int $weight
     *
     * @return Promotion
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return string
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param string $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return PromotionsTyres[]|ArrayCollection
     */
    public function getPromotionsTyres()
    {
        return $this->promotionsTyres;
    }

    /**
     * @param PromotionsTyres[]|ArrayCollection $promotionsTyres
     */
    public function setPromotionsTyres($promotionsTyres)
    {
        $this->promotionsTyres = $promotionsTyres;
    }

    /**
     * @param $promotionsTyre
     */
    public function addPromotionsTyre($promotionsTyre){
        $this->promotionsTyres[]=$promotionsTyre;
    }

    /**
     * @return mixed
     */
    public function getSellerId()
    {
        return $this->sellerId;
    }

    /**
     * @param mixed $sellerId
     */
    public function setSellerId($sellerId)
    {
        $this->sellerId = $sellerId;
    }


}
