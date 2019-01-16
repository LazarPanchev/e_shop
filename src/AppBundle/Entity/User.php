<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[0-9a-z]{5,}$/",
     *     match=true,
     *     message="Your password must contains lower case letters or digits. Minimum 5 symbols!"
     * )
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(name="fullName", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Your full name must be at least {{ limit }} characters long",
     *      maxMessage = "Your full name cannot be longer than {{ limit }} characters"
     * )
     */
    private $fullName;

    /**
     * @var string
     * @ORM\Column(name="address", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Your address must be at least {{ limit }} characters long",
     *      maxMessage = "Your address cannot be longer than {{ limit }} characters"
     * )
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[0-9]{10,12}$/",
     *     match=true,
     *     message="Your phone must contains between 10 and 12 digits ."
     * )
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="money", type="decimal", precision=10, scale=2)
     * @Assert\Range(
     *      min = 1,
     *      max = 10000,
     *      minMessage = "You must deposit min{{ limit }} lv.",
     *      maxMessage = "You can't deposit more than {{ limit }} lv."
     * )
     */
    private $money;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var bool
     *
     * @ORM\Column(name="isBanned", type="boolean")
     */
    private $isBanned;

    /**
     * @var ArrayCollection|Role[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role", inversedBy="users")
     * @ORM\JoinTable(name="users_roles",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *     )
     */
    private $roles;

    /**
     * @var ArrayCollection|Tyre[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Tyre", mappedBy="seller", cascade={"remove"})
     */
    private $tyres;

    /**
     * @var ArrayCollection|Comment[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="author", cascade={"remove"})
     */
    private $comments;

    /**
     * @var string
     * @ORM\Column(name="avatar", type="string", nullable=true)
     */
    private $avatar;

    /**
     * @var ArrayCollection|Purchase[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Purchase",mappedBy="userId")
     */
    private $purchases;

    /**
     * @var ArrayCollection|Promotion[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Promotion",mappedBy="seller")
     */
    private $promotions;



    public function __construct()
    {
        $this->dateCreated = new \DateTime('now');
        $this->isBanned = false;
        $this->roles = new ArrayCollection();
        $this->tyres = new ArrayCollection();
        $this->comments = new  ArrayCollection();
        $this->purchases = new ArrayCollection();
        $this->promotions= new ArrayCollection();
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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set money
     *
     * @param string $money
     *
     * @return User
     */
    public function setMoney($money)
    {

        $this->money = $money;

        return $this;
    }

    /**
     * Get money
     *
     * @return string
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return User
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set isBanned
     *
     * @param boolean $isBanned
     *
     * @return User
     */
    public function setIsBanned($isBanned)
    {
        $this->isBanned = $isBanned;

        return $this;
    }

    /**
     * Get isBanned
     *
     * @return bool
     */
    public function getIsBanned()
    {
        return $this->isBanned;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return array('ROLE_USER');
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return array (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $stringRoles = [];
        foreach ($this->roles as $role) {
            /** @var Role $role */
            $stringRoles[] = $role->getRole();
        }
        return $stringRoles;
    }

    /**
     * @param Role $role
     *
     * @return User
     */
    public function addRole(Role $role)
    {
        $this->roles[] = $role;
        return $this;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return Tyre[]|ArrayCollection
     */
    public function getTyres()
    {
        return $this->tyres;
    }

    /**
     * @param Tyre $tyre
     * @return User
     */
    public function addTyre(Tyre $tyre)
    {
        $this->tyres[] = $tyre;
        return $this;
    }

    /**
     * @param Tyre $tyre
     * @return bool
     */
    public function isSeller(Tyre $tyre)
    {
        //id of the current logged user
        return $tyre->getSeller()->getId() === $this->getId();
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return in_array('ROLE_ADMIN', $this->getRoles());
    }

    /**
     * @return Comment[]|ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comment|null $comment
     * @return User
     */
    public function addComment(Comment $comment = null)
    {
        $this->comments[] = $comment;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar(string $avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return Purchase[]|ArrayCollection
     */
    public function getPurchases()
    {
        return $this->purchases;
    }


    /**
     * @param Purchase $purchase
     * @return User
     */
    public function addPurchase(Purchase $purchase)
    {
        $this->purchases[] = $purchase;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEditor()
    {
        return in_array('ROLE_EDITOR', $this->getRoles());
    }

    /**
     * @return Promotion[]|ArrayCollection
     */
    public function getPromotions()
    {
        return $this->promotions;
    }

    /**
     * @param Promotion[]|ArrayCollection $promotions
     */
    public function setPromotions($promotions)
    {
        $this->promotions = $promotions;
    }

    /**
     * @param Promotion $promotion
     */
    public function addPromotion(Promotion $promotion){
        $this->promotions[]=$promotion;
    }

//    public function __sleep(){
//        return array($this->getId(), $this->getUsername(), $this->getEmail());
//    }
}

