<?php

namespace AppBundle\Controller;

/**
 * Description of ItemsController
 *
 * @author Ezequiel
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ItemsController extends Controller {

    public function getItemsAction() {
        $items = $this->getDoctrine()
                ->getRepository('AppBundle:Item')
                ->findAll();

        if (!$items) {
            throw $this->createNotFoundException(
                    'No items found'
            );
        }

        return $items;
    }

// "get_items"   [GET] /items

    public function getItemAction($itemid) {
        $item = $this->getDoctrine()
                ->getRepository('AppBundle:Item')
                ->find($itemid);

        if (!$item) {
            throw $this->createNotFoundException(
                    'No item found for id ' . $itemid
            );
        }

        return $item;
    }

// "get_item"   [GET] /items/{itemid}
}
