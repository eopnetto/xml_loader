<?php

namespace AppBundle\Controller;

/**
 * Description of ShipordersController
 *
 * @author Ezequiel
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShipordersController extends Controller {    
    
    public function getShipordersAction() {
        $shiporders = $this->getDoctrine()
                ->getRepository('AppBundle:Shiporder')
                ->findAll();

        if (!$shiporders) {
            throw $this->createNotFoundException(
                    'No shiporders found'
            );
        }

        return $shiporders;
    }

// "get_shiporders"   [GET] /shiporders

    public function getShiporderAction($orderid) {
        $shiporder = $this->getDoctrine()
                ->getRepository('AppBundle:Shiporder')
                ->find($orderid);

        if (!$shiporder) {
            throw $this->createNotFoundException(
                    'No shiporder found for id ' . $orderid
            );
        }

        return $shiporder;
    }

// "get_shiporder"   [GET] /shiporders/{orderid}

    
    public function getShipordersItemsAction($orderid) {
        $shiporder = $this->getDoctrine()
                ->getRepository('AppBundle:Shiporder')
                ->find($orderid);

        if ($shiporder) {
            $items = $shiporder->getItems();

            if (!$items) {
                throw $this->createNotFoundException(
                        'No items found for orderid ' . $orderid
                );
            }
        } else {
            throw $this->createNotFoundException(
                    'No shiporder found for id ' . $orderid
            );
        }

        return $items;
    }

// "get_shiporder_items"   [GET] /shiporders/{orderid}/items

    public function getShipordersItemAction($orderid, $itemid) {
        $shiporder = $this->getDoctrine()
                ->getRepository('AppBundle:Shiporder')
                ->find($orderid);

        if ($shiporder) {
            $items = $shiporder->getItems();

            if (!$items) {
                throw $this->createNotFoundException(
                        'No items found for orderid ' . $orderid
                );
            }

            foreach ($items as $value) {
                if ($value->getItemid() == $itemid)
                    $item = $value;
            }

            if (!isset($item)) {
                throw $this->createNotFoundException(
                        "Shiporder $orderid has no item found for id  $itemid"
                );
            }
        } else {
            throw $this->createNotFoundException(
                    'No shiporder found for id ' . $orderid
            );
        }

        return $item;
    }
// "get_shiporder_items"   [GET] /shiporders/{orderid}/items/{itemid}
    
////=================================================
    // "get_person_shiporder"    [GET] /shiporders/{personid}/shiporders/{orderid}

//    public function getShipordersAction($personid) {
//        $person = $this->getDoctrine()
//                ->getRepository('AppBundle:Person')
//                ->find($personid);
//
//        if ($person) {
//            $shiporders = $person->getShiporders();
//
//            if (!$shiporders) {
//                throw $this->createNotFoundException(
//                        'No shiporders found for personid ' . $personid
//                );
//            }
//        } else {
//            throw $this->createNotFoundException(
//                    'No person found for id ' . $personid
//            );
//        }
//
//        return $shiporders;
//    }
//
//// "get_person_shiporders"   [GET] /shiporders/{personid}/shiporders
//
//    public function getShiporderAction($personid, $orderid) {
//        $person = $this->getDoctrine()
//                ->getRepository('AppBundle:Person')
//                ->find($personid);
//
//        if ($person) {
//            $shiporders = $person->getShiporders();
//
//            if (!$shiporders) {
//                throw $this->createNotFoundException(
//                        'No shiporders found for personid ' . $personid
//                );
//            }
//
//            foreach ($shiporders as $value) {
//                if ($value->getOrderid() == $orderid)
//                    $shiporder = $value;
//            }
//
//            if (!isset($shiporder)) {
//                throw $this->createNotFoundException(
//                        "Person $personid has no shiporder found for id  $orderid"
//                );
//            }
//        } else {
//            throw $this->createNotFoundException(
//                    'No person found for id ' . $personid
//            );
//        }
//
//        return $shiporder;
//    }
//
//    // "get_person_shiporder"    [GET] /shiporders/{personid}/shiporders/{orderid}
}
