<?php

namespace AppBundle\Controller;

/**
 * Description of PeopleController
 *
 * @author Ezequiel
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PeopleController extends Controller {

    public function getPeopleAction() {
        $people = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->findAll();

        if (!$people) {
            throw $this->createNotFoundException(
                    'No people found'
            );
        }

        return $people;
    }

// "get_people"   [GET] /people

    public function getPersonAction($personid) {
        $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($personid);

        if (!$person) {
            throw $this->createNotFoundException(
                    'No person found for id ' . $personid
            );
        }

        return $person;
    }

// "get_person"   [GET] /people/{personid}

    public function getPeoplePhonesAction($personid) {
        $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($personid);

        if ($person) {
            $phones = $person->getPhones();

            if (!$phones) {
                throw $this->createNotFoundException(
                        'No phones found for personid ' . $personid
                );
            }
        } else {
            throw $this->createNotFoundException(
                    'No person found for id ' . $personid
            );
        }

        return $phones;
    }

// "get_person_phones"   [GET] /people/{personid}/phones

    public function getPeoplePhoneAction($personid, $phoneid) {
        $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($personid);

        if ($person) {
            $phones = $person->getPhones();

            if (!$phones) {
                throw $this->createNotFoundException(
                        'No phones found for personid ' . $personid
                );
            }

            foreach ($phones as $value) {
                if ($value->getPhoneid() == $phoneid)
                    $phone = $value;
            }

            if (!isset($phone)) {
                throw $this->createNotFoundException(
                        "Person $personid has no phone found for id  $phoneid"
                );
            }
        } else {
            throw $this->createNotFoundException(
                    'No person found for id ' . $personid
            );
        }

        return $phone;
    }

// "get_person_phones"   [GET] /people/{personid}/phones/{phoneid}

    public function getPeopleShipordersAction($personid) {
        $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($personid);

        if ($person) {
            $shiporders = $person->getShiporders();

            if (!$shiporders) {
                throw $this->createNotFoundException(
                        'No shiporders found for personid ' . $personid
                );
            }
        } else {
            throw $this->createNotFoundException(
                    'No person found for id ' . $personid
            );
        }

        return $shiporders;
    }

// "get_person_shiporders"   [GET] /people/{personid}/shiporders

    public function getPeopleShiporderAction($personid, $orderid) {
        $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($personid);

        if ($person) {
            $shiporders = $person->getShiporders();

            if (!$shiporders) {
                throw $this->createNotFoundException(
                        'No shiporders found for personid ' . $personid
                );
            }

            foreach ($shiporders as $value) {
                if ($value->getOrderid() == $orderid)
                    $shiporder = $value;
            }

            if (!isset($shiporder)) {
                throw $this->createNotFoundException(
                        "Person $personid has no shiporder found for id  $orderid"
                );
            }
        } else {
            throw $this->createNotFoundException(
                    'No person found for id ' . $personid
            );
        }

        return $shiporder;
    }

    // "get_person_shiporder"    [GET] /people/{personid}/shiporders/{orderid}    
}
