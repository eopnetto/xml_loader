<?php

namespace AppBundle\Controller;

/**
 * Description of PhonesController
 *
 * @author Ezequiel
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PhonesController extends Controller {

    public function getPhonesAction() {
        $phones = $this->getDoctrine()
                ->getRepository('AppBundle:Phone')
                ->findAll();

        if (!$phones) {
            throw $this->createNotFoundException(
                    'No phones found'
            );
        }

        return $phones;
    }

// "get_phones"   [GET] /phones

    public function getPhoneAction($phoneid) {
        $phone = $this->getDoctrine()
                ->getRepository('AppBundle:Phone')
                ->find($phoneid);

        if (!$phone) {
            throw $this->createNotFoundException(
                    'No phone found for id ' . $phoneid
            );
        }

        return $phone;
    }

// "get_phone"   [GET] /phones/{phoneid}

}
