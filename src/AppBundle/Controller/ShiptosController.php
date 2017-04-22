<?php

namespace AppBundle\Controller;

/**
 * Description of ShiptosController
 *
 * @author Ezequiel
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShiptosController extends Controller {

    public function getShiptosAction() {
        $shiptos = $this->getDoctrine()
                ->getRepository('AppBundle:Shipto')
                ->findAll();

        if (!$shiptos) {
            throw $this->createNotFoundException(
                    'No shiptos found'
            );
        }

        return $shiptos;
    }

// "get_shiptos"   [GET] /shiptos

    public function getShiptoAction($shiptoid) {
        $shipto = $this->getDoctrine()
                ->getRepository('AppBundle:Shipto')
                ->find($shiptoid);

        if (!$shipto) {
            throw $this->createNotFoundException(
                    'No shipto found for id ' . $shiptoid
            );
        }

        return $shipto;
    }

// "get_shipto"   [GET] /shiptos/{shiptoid}    

    public function getShiptosShipordersAction($shiptoid) {
        $shipto = $this->getDoctrine()
                ->getRepository('AppBundle:Shipto')
                ->find($shiptoid);

        if ($shipto) {
            $shiporders = $shipto->getShiporders();

            if (!$shiporders) {
                throw $this->createNotFoundException(
                        'No shiporders found for shiptoid ' . $shiptoid
                );
            }
        } else {
            throw $this->createNotFoundException(
                    'No shipto found for id ' . $shiptoid
            );
        }

        return $shiporders;
    }

// "get_shipto_shiporders"   [GET] /shiptos/{shiptoid}/shiporders

    public function getShiptosShiporderAction($shiptoid, $orderid) {
        $shipto = $this->getDoctrine()
                ->getRepository('AppBundle:Shipto')
                ->find($shiptoid);

        if ($shipto) {
            $shiporders = $shipto->getShiporders();

            if (!$shiporders) {
                throw $this->createNotFoundException(
                        'No shiporders found for shiptoid ' . $shiptoid
                );
            }

            foreach ($shiporders as $value) {
                if ($value->getOrderid() == $orderid)
                    $shiporder = $value;
            }

            if (!isset($shiporder)) {
                throw $this->createNotFoundException(
                        "Shipto $shiptoid has no shiporder found for id  $orderid"
                );
            }
        } else {
            throw $this->createNotFoundException(
                    'No shipto found for id ' . $shiptoid
            );
        }

        return $shiporder;
    }

    // "get_shipto_shiporder"    [GET] /shiptos/{shiptoid}/shiporders/{orderid}    
}
