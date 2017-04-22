<?php

/**
 * Description of Shiporder
 *
 * @author Ezequiel
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="shiporder")
 */
class Shiporder {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $orderid;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $personid;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shiptoid;

    /**
     * Many Shiporders have One Person.
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="shiporders")
     * @ORM\JoinColumn(name="personid", referencedColumnName="personid")
     */
    private $person;

    public function setPerson($person) {
        $this->person = $person;

        return $this;
    }

    /**
     * Many Shiporders have One Shipto.
     * @ORM\ManyToOne(targetEntity="Shipto", inversedBy="shiporders")
     * @ORM\JoinColumn(name="shiptoid", referencedColumnName="shiptoid")
     */
    private $shipto;

    public function setShipto($shipto) {
        $this->shipto = $shipto;

        return $this;
    }

    /**
     * One Shipto has Many Items.
     * @ORM\OneToMany(targetEntity="Item", mappedBy="shiporder")
     */
    private $items;

    public function __construct() {
        $this->items = new ArrayCollection();
    }

    public function getItems() {
        return $this->items;
    }

    /**
     * Set orderperson
     *
     * @param integer $orderid
     * @return Shiporder
     */
    public function setOrderid($orderid) {
        $this->orderid = $orderid;

        return $this;
    }

    /**
     * Get orderid
     *
     * @return integer 
     */
    public function getOrderid() {
        return $this->orderid;
    }

    /**
     * Set personid
     *
     * @param integer $personid
     * @return Shiporder
     */
    public function setPersonid($personid) {
        $this->personid = $personid;

        return $this;
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
     * Set shiptoid
     *
     * @param integer $shiptoid
     * @return Shiporder
     */
    public function setShiptoid($shiptoid) {
        $this->shiptoid = $shiptoid;

        return $this;
    }

    /**
     * Get shiptoid
     *
     * @return integer 
     */
    public function getShiptoid() {
        return $this->shiptoid;
    }

}
