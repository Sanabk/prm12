<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as JMSSerializer;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 *
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\AccessorOrder("custom", custom = {"id", "username", "email", "accounts"})
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"users_all","users_summary"})
     */
    protected $id;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"users_all","users_summary"})
     */
    protected $username;
    /**
     * @var string The email of the user.
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"users_all","users_summary"})
     */
    protected $email;
    /**
     * User constructor.
     */


//    /**
//     * @ORM\Id
//     * @ORM\Column(type="integer")
//     * @ORM\GeneratedValue(strategy="AUTO")
//     */
//    protected $id;
//
//    /**
//     * @ORM\Column(type="string", length=255)
//     *
//     * @Assert\NotBlank(message="Please chose your type.", groups={"Registration", "Profile"})
//     * @Assert\Length(
//     *     min=3,
//     *     max=255,
//     *     minMessage="The name is too short.",
//     *     maxMessage="The name is too long.",
//     *     groups={"Registration", "Profile"}
//     * )
//     */
//    protected $type;



//    /**
//     * @ManyToMany(targetEntity="Annonce", inversedBy="users")
//     * @JoinTable(name="users_annonces")
//     */
//
//    private $annonces;
//    /**
//     * @ManyToMany(targetEntity="Reclamation", inversedBy="users")
//     * @JoinTable(name="users_reclamations")
//     */
//
//    private $reclamations;
//
//    /**
//     * @return mixed
//     */
//    public function getReclamations()
//    {
//        return $this->reclamations;
//    }
//
//    /**
//     * @param mixed $reclamations
//     */
//    public function setReclamations($reclamations)
//    {
//        $this->reclamations = $reclamations;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getAnnonces()
//    {
//        return $this->annonces;
//    }
//
//    /**
//     * @param mixed $annonces
//     */
//    public function setAnnonces($annonces)
//    {
//        $this->annonces = $annonces;
//    }
//
//    public function __construct()
//    {
//        parent::__construct();
//        // your own logic
//        $this->annonces = new ArrayCollection();
//    }
//
//    public function __construct1()
//    {
//        parent::__construct();
//        // your own logic
//        $this->reclamations = new ArrayCollection();
//    }
//    /**
//     * Set type
//     *
//     * @param string $type
//     *
//     * @return User
//     */
//    public function setType($type)
//    {
//        $this->type = $type;
//
//        return $this;
//    }
//
//    /**
//     * Get type
//     *
//     * @return string
//     */
//    public function getType()
//    {
//        return $this->type;
//    }
}
