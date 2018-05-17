<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnnonceRepository")
 *
 */
class Annonce
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=255)
     *
     * @Assert\NotBlank
     *
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     *
     * @Assert\NotBlank
     *
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="categ", type="string", length=255)
     *
     * @Assert\NotBlank
     *
     */
    private $categ;

    /**
     * @return mixed
     */
    public function getCateg()
    {
        return $this->categ;
    }

    /**
     * @param mixed $categ
     */
    public function setCateg($categ)
    {
        $this->categ = $categ;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="anoncateg")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */

    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     *
     * @Assert\NotBlank
     */
    private $city;

    /**
     * @var int
     *
     * @ORM\Column(name="Phone", type="integer")
     *
     * @Assert\NotBlank
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="Picture", type="string", length=255)
     */
    private $picture;
    /**
     * @OneToMany(targetEntity="AppBundle\Entity\Listreq", mappedBy="service")
     */
    private $req;

    /**
     * @return mixed
     */
    public function getReq()
    {
        return $this->req;
    }

    /**
     * @param mixed $req
     */
    public function setReq($req)
    {
        $this->req = $req;
    }


    /**
     * @ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="annonces")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    /**
     * Get id
     *
     * @return int
     */



    /**
     * @return mixed
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Annonce
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Annonce
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
     * Set category
     *
     * @param string $category
     *
     * @return Annonce
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Annonce
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return Annonce
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Annonce
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }


    public function __toString()
    {
        return $this->getTitle();
    }
    public function __construct()
    {
        $this->req = new ArrayCollection();
    }
}

