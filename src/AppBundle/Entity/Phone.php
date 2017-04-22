<?php

/**
 * Description of Phone
 *
 * @author Ezequiel
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Person;

/**
 * @ORM\Entity
 * @ORM\Table(name="phone")
 */
class Phone {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $phoneid;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $personid;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $phone;

    /**
     * Many Phones have One Person.
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="phones")
     * @ORM\JoinColumn(name="personid", referencedColumnName="personid")
     */
    private $person;

    public function setPerson($person) {
        $this->person = $person;

        return $this;
    }

    /**
     * Get phoneid
     *
     * @return integer 
     */
    public function getPhoneid() {
        return $this->phoneid;
    }

    /**
     * Set personid
     *
     * @param integer $personid
     * @return Phone
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
     * Set phone
     *
     * @param string $phone
     * @return Phone
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone() {
        return $this->phone;
    }

}
