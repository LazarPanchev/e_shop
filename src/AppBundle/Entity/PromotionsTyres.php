<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PromotionsTyres
 *
 * @ORM\Table(name="promotions_tyres")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PromotionsTyresRepository")
 */
class PromotionsTyres
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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Promotion", inversedBy="promotionsTyres")
     * @ORM\JoinColumn(name="promotion_id", referencedColumnName="id")
     */
    private $promotionId;

    /**
     * @var int
     *
     * @ORM\Column(name="tyreId", type="integer")
     */
    private $tyreId;



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
     * Set promotionId.
     *
     * @param int $promotionId
     *
     * @return PromotionsTyres
     */
    public function setPromotionId($promotionId)
    {
        $this->promotionId = $promotionId;

        return $this;
    }

    /**
     * Get promotionId.
     *
     * @return int
     */
    public function getPromotionId()
    {
        return $this->promotionId;
    }

    /**
     * Set tyreId.
     *
     * @param int $tyreId
     *
     * @return PromotionsTyres
     */
    public function setTyreId($tyreId)
    {
        $this->tyreId = $tyreId;

        return $this;
    }

    /**
     * Get tyreId.
     *
     * @return int
     */
    public function getTyreId()
    {
        return $this->tyreId;
    }
}
