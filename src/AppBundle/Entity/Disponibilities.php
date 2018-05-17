<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Disponibilities
 *
 * @ORM\Table(name="disponibilities")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DisponibilitiesRepository")
 */
class Disponibilities
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
     * @ORM\Column(name="Day", type="string", length=255)
     */
    private $day;

    /**
     * @var string
     *
     * @ORM\Column(name="Fromo", type="string", length=255)
     */
    private $fromo;

    /**
     * @var string
     *
     * @ORM\Column(name="Too", type="string", length=255)
     */
    private $too;

    /**
     * @var string
     *
     * @ORM\Column(name="Fromt", type="string", length=255)
     */
    private $fromt;

    /**
     * @var string
     *
     * @ORM\Column(name="Tot", type="string", length=255)
     */
    private $tot;
    /**
     * @ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="dispo")
     * @JoinColumn(name="professional_id", referencedColumnName="id")
     */
    private $prof;



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
     * Set day
     *
     * @param string $day
     *
     * @return Disponibilities
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set fromo
     *
     * @param string $fromo
     *
     * @return Disponibilities
     */
    public function setFromo($fromo)
    {
        $this->fromo = $fromo;

        return $this;
    }

    /**
     * Get fromo
     *
     * @return string
     */
    public function getFromo()
    {
        return $this->fromo;
    }

    /**
     * Set too
     *
     * @param string $too
     *
     * @return Disponibilities
     */
    public function setToo($too)
    {
        $this->too = $too;

        return $this;
    }

    /**
     * Get too
     *
     * @return string
     */
    public function getToo()
    {
        return $this->too;
    }

    /**
     * Set fromt
     *
     * @param string $fromt
     *
     * @return Disponibilities
     */
    public function setFromt($fromt)
    {
        $this->fromt = $fromt;

        return $this;
    }

    /**
     * Get fromt
     *
     * @return string
     */
    public function getFromt()
    {
        return $this->fromt;
    }

    /**
     * Set tot
     *
     * @param string $tot
     *
     * @return Disponibilities
     */
    public function setTot($tot)
    {
        $this->tot = $tot;

        return $this;
    }

    /**
     * Get tot
     *
     * @return string
     */
    public function getTot()
    {
        return $this->tot;
    }

    /**
     * @return mixed
     */
    public function getProf()
    {
        return $this->prof;
    }

    /**
     * @param mixed $prof
     */
    public function setProf($prof)
    {
        $this->prof = $prof;
    }
}

