<?php

/**
 * Description of Shiporder
 *
 * @author Ezequiel
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="integer")
     */
    private $orderperson;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shiptoid;

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
     * Set orderperson
     *
     * @param integer $orderperson
     * @return Shiporder
     */
    public function setOrderperson($orderperson) {
        $this->orderperson = $orderperson;

        return $this;
    }

    /**
     * Get orderperson
     *
     * @return integer 
     */
    public function getOrderperson() {
        return $this->orderperson;
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
