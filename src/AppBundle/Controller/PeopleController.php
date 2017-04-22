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
}
