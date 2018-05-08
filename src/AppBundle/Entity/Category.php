<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;
    /**
     * @ORM\OneToMany(targetEntity="Annonce", mappedBy="category")
     */
    private $anoncateg;

    /**
     * @return mixed
     */
    public function getAnoncateg()
    {
        return $this->anoncateg;
    }

    /**
     * @param mixed $anoncateg
     */
    public function setAnoncateg($anoncateg)
    {
        $this->anoncateg = $anoncateg;
    }

    public function __construct()
    {
        $this->anoncateg = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    public function __toString()
    {
        return $this->getName(); // à mettre ici ce que tu veux
    }
}

