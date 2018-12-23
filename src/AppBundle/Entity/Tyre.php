<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tyre
 *
 * @ORM\Table(name="tyres")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TyreRepository")
 *
 */
class Tyre
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
     * @Assert\NotBlank(message="Choose a Brand")
     * @ORM\Column(name="make", type="string", length=255)
     */
    private $make;

    /**
     * @var string
     * @Assert\NotBlank(message="Choose a Model")
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;

    /**
     * @var int
     * @Assert\NotBlank(message="Choose tyre width")
     * @Assert\Range(
     *      min = 30,
     *      max = 355,
     *      minMessage = "Tyre width must be at least {{ limit }}cm width",
     *      maxMessage = "Tyre width cannot be more than {{ limit }}cm width"
     * )
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @var int
     * @Assert\NotBlank(message="Choose tyre height")
     * @Assert\Range(
     *      min = 9,
     *      max = 80,
     *      minMessage = "Tyre height must be at least {{ limit }}cm height",
     *      maxMessage = "Tyre height cannot be more than {{ limit }}cm height"
     * )
     * @ORM\Column(name="height", type="integer")
     */
    private $height;

    /**
     * @var int
     * @Assert\NotBlank(message="Choose tyre Diameter")
     * @Assert\Range(
     *      min = 12,
     *      max = 24,
     *      minMessage = "Rim Diameter must be at least {{ limit }}.",
     *      maxMessage = "Rim Diameter cannot be more than {{ limit }}."
     * )
     * @ORM\Column(name="diameter", type="integer")
     */
    private $diameter;

    /**
     * @var string
     *
     * @ORM\Column(name="speedIndex", type="string", length=255, nullable=true)
     */
    private $speedIndex;

    /**
     * @var string
     *
     * @ORM\Column(name="loadIndex", type="string", length=255, nullable=true)
     */
    private $loadIndex;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetime")
     */
    private $createDate;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="tyres")
     * @ORM\JoinColumn(name="seller_id", referencedColumnName="id")
     */
    private $seller;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="tyres")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @Assert\NotBlank(message="Must choose category")
     */
    private $category;

    /**
     * @var
     * @ORM\Column(name="image", type="string", nullable=false)
     * @Assert\NotBlank(message="You must select a picture!")
     */
    private $image;

    /**
     * @var int
     * @ORM\Column(name="view_count", type="integer")
     */
    private $viewCount;

    /**
     * @var ArrayCollection|Comment[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="tyre", cascade={"remove"})
     */
    private $comments;

    public function __construct()
    {
        $this->createDate=new \DateTime('now');
        $this->comments=new  ArrayCollection();
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
     * Set make
     *
     * @param string $make
     *
     * @return Tyre
     */
    public function setMake($make)
    {
        $this->make = $make;

        return $this;
    }

    /**
     * Get make
     *
     * @return string
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return Tyre
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set width
     *
     * @param integer $width
     *
     * @return Tyre
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     *
     * @return Tyre
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set diameter
     *
     * @param integer $diameter
     *
     * @return Tyre
     */
    public function setDiameter($diameter)
    {
        $this->diameter = $diameter;

        return $this;
    }

    /**
     * Get diameter
     *
     * @return int
     */
    public function getDiameter()
    {
        return $this->diameter;
    }

    /**
     * Set speedIndex
     *
     * @param string $speedIndex
     *
     * @return Tyre
     */
    public function setSpeedIndex($speedIndex)
    {
        $this->speedIndex = $speedIndex;

        return $this;
    }

    /**
     * Get speedIndex
     *
     * @return string
     */
    public function getSpeedIndex()
    {
        return $this->speedIndex;
    }

    /**
     * Set loadIndex
     *
     * @param string $loadIndex
     *
     * @return Tyre
     */
    public function setLoadIndex($loadIndex)
    {
        $this->loadIndex = $loadIndex;

        return $this;
    }

    /**
     * Get loadIndex
     *
     * @return string
     */
    public function getLoadIndex()
    {
        return $this->loadIndex;
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
     * @return User
     */
    public function getSeller(): User
    {
        return $this->seller;
    }

    /**
     * @param User $seller
     * @return Tyre
     */
    public function setSeller($seller=null)
    {
        $this->seller = $seller;
        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return Tyre
     */
    public function setCategory( $category=null)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    /**
     * @param int $viewCount
     */
    public function setViewCount(int $viewCount)
    {
        $this->viewCount = $viewCount;
    }

    public function increaseCount(){
        $this->viewCount++;
    }

    /**
     * @return Comment[]|ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comment[]|ArrayCollection $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }






}

