<?php

/**
 * Description of Person
 *
 * @author Ezequiel
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Phone;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class Person {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * 
     */
    private $personid;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $personname;

    /**
     * One Person has Many Phones.
     * @ORM\OneToMany(targetEntity="Phone", mappedBy="person")
     */
    private $phones;

    /**
     * One Person has Many Shiporders.
     * @ORM\OneToMany(targetEntity="Shiporder", mappedBy="person")
     */
    private $shiporders;

    public function __construct() {
        $this->phones = new ArrayCollection();
        $this->shiporders = new ArrayCollection();
    }

    public function getPhones() {
        return $this->phones;
    }

    public function getShiporders() {
        return $this->shiporders;
    }

    /**
     * Get personid
     *
     * @return integer 
     */
    public function getPersonid() {
        return $this->personid;
    }

    /**
     * Set personid
     *
     * @param string $personid 
     * @return Person
     */
    public function setPersonid($personid) {
        $this->personid = $personid;

        return $this;
    }

    /**
     * Set personname
     *
     * @param string $personname
     * @return Person
     */
    public function setPersonname($personname) {
        $this->personname = $personname;

        return $this;
    }

    /**
     * Get personname
     *
     * @return string 
     */
    public function getPersonname() {
        return $this->personname;
    }

}
