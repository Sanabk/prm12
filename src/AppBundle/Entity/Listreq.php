<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\ManyToOne;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Listreq
 *
 * @ORM\Table(name="Listreq")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ListreqRepository")
 */
class Listreq
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
     * @ManyToOne(targetEntity="AppBundle\Entity\Annonce", inversedBy="req")
     * @JoinColumn(name="service_id", referencedColumnName="id")
     */
    private $service;

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @var string
     *f
     * @ORM\Column(name="jour", type="string", length=255)
     */
    private $jour;
    /**
     * @var string
     *
     * @ORM\Column(name="fromo", type="string", length=255)
     */
    private $fromo;
    /**
     * @var string
     *
     * @ORM\Column(name="toon", type="string", length=255)
     */
    private $toon;
    /**
     * @var string
     *
     * @ORM\Column(name="valid", type="string", length=255)
     */
    private $valid;

    /**
     * @return string
     */
    public function getValid(): string
    {
        return $this->valid;
    }

    /**
     * @param string $valid
     */
    public function setValid(string $valid)
    {
        $this->valid = $valid;
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
     * Set subject
     *
     * @param string $subject
     *
     * @return Listreq
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set jour
     *
     * @param string $jour
     *
     * @return Listreq
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return string
     */
    public function getJour()
    {
        return $this->Jour;
    }
    /**
     * @ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="rdv")
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
     * @return string
     */
    public function getToon(): string
    {
        return $this->toon;
    }

    /**
     * @param string $toon
     */
    public function setToon(string $toon)
    {
        $this->toon = $toon;
    }

    /**
     * @return string
     */
    public function getFromo(): string
    {
        return $this->fromo;
    }

    /**
     * @param string $fromo
     */
    public function setFromo(string $fromo)
    {
        $this->fromo = $fromo;
    }
}

