<?php

namespace AppBundle\Controller;

/**
 * Description of PhonesController
 *
 * @author Ezequiel
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PhonesController extends Controller {

    public function getPhonesAction($personid) {
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

    public function getPhoneAction($personid, $phoneid) {
        
    }

    // "get_person_phone"    [GET] /people/{personid}/phones/{phoneid}

    public function newPhonesAction($personid) {
        
    }

// "new_person_phones"   [GET] /people/{personid}/phones/new

    public function editPhoneAction($personid, $phoneid) {
        
    }

// "edit_person_phone"   [GET] /people/{personid}/phones/{phoneid}/edit

    public function removePhoneAction($personid, $phoneid) {
        
    }

// "remove_person_phone" [GET] /people/{personid}/phones/{phoneid}/remove
}
