<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;

class HomeController extends FOSRestController {

    public $UPLOAD_DIR = __DIR__ . '/../../../web/uploads';

    /**
     * @Route("/")
     */
    public function index() {
        $view = $this->view(['successAlert' => false, 'errorAlert' => false], 200)
                ->setTemplate("index.twig")
                ->setTemplateVar('data');

        return $this->handleView($view);
    }

    /**
     * @Route("/upload")
     */
    public function upload() {
        try {
            $uploadedFile = $this->getRequest()->files->get('file');
            $directory = $this->UPLOAD_DIR;

            $uploadedFile->move($directory, $uploadedFile->getClientOriginalName());
            $result = $this->process($uploadedFile);

            if ($result) {
                $view = $this->view([
                            'success' => true,
                            'message' => '<b>Success!</b> Your file has been processed'
                                ], 200)
                        ->setTemplate("_alert.twig")
                        ->setTemplateVar('data');

                return $this->handleView($view);
            }
        } catch (\Exception $exc) {
            var_dump($exc->getMessage());
            var_dump($exc->getLine());
        }

        $view = $this->view([
                    'success' => false,
                    'message' => '<b>Ops!</b> Looks like something went wrong'
                        ], 200)
                ->setTemplate("_alert.twig")
                ->setTemplateVar('data');

        return $this->handleView($view);
    }

    /**
     * @Route("/process/{file}")
     */
    public function process($uploadedFile) {
        $doc = new \DOMDocument();
        if (is_file($this->UPLOAD_DIR . '/' . $uploadedFile->getClientOriginalName())) {
            $doc->load($this->UPLOAD_DIR . '/' . $uploadedFile->getClientOriginalName());

            $this->processPerson($doc);
            $this->processShiporder($doc);

            return true;
        }
        return false;
    }

    public function processPerson($doc) {
        $em = $this->getDoctrine()->getManager();
        try {
            $people = $doc->getElementsByTagName('person');
            if ($people) {
                $em->getConnection()->beginTransaction();

                foreach ($people as $person) {
                    $personid = $person->getElementsByTagName('personid')->item(0)->nodeValue;
                    $repository = $this->getDoctrine()->getRepository('AppBundle:Person');
                    $personObj = $repository->find($personid);

                    if (is_null($personObj)) {
                        $personObj = new \AppBundle\Entity\Person();
                        $personObj->setPersonid($personid);
                        $personObj->setPersonname($person->getElementsByTagName('personname')->item(0)->nodeValue);
                        $em->persist($personObj);
                        $em->flush();

                        $phones = $person->getElementsByTagName('phone');
                        foreach ($phones as $phone) {
                            $phoneObj = new \AppBundle\Entity\Phone();
                            $phoneObj->setPhone($phone->nodeValue);
                            $personObj->getPhones()->add($phoneObj);
                            $phoneObj->setPerson($personObj);
                            $em->persist($phoneObj);
                            $em->flush();
                        }
                    }
                }

                $em->getConnection()->commit();
                return $people;
            }
        } catch (\Exception $exc) {
            var_dump($exc->getMessage());
            var_dump($exc->getLine());
            $em->getConnection()->rollBack();
        }
    }

    public function processShiporder($doc) {
        $em = $this->getDoctrine()->getManager();
        try {
            $shiporders = $doc->getElementsByTagName('shiporder');
            if ($shiporders) {
                $em->getConnection()->beginTransaction();
                foreach ($shiporders as $shiporder) {
                    $orderid = $shiporder->getElementsByTagName('orderid')->item(0)->nodeValue;
                    $repository = $this->getDoctrine()->getRepository('AppBundle:Shiporder');
                    $shiporderObj = $repository->find($orderid);
                    $personObj = $this->getDoctrine()->getRepository('AppBundle:Person')->find($shiporder->getElementsByTagName('orderperson')->item(0)->nodeValue);

                    if (is_null($shiporderObj) && $personObj) {
                        $shiporderObj = new \AppBundle\Entity\Shiporder();
                        $shiporderObj->setOrderid($orderid);
//                        $shiporderObj->setPersonid($shiporder->getElementsByTagName('orderperson')->item(0)->nodeValue);
                        $personObj->getShiporders()->add($shiporderObj);
                        $shiporderObj->setPerson($personObj);
                        $em->persist($shiporderObj);
                        $em->flush();

                        $shipto = $shiporder->getElementsByTagName('shipto')->item(0);
                        if ($shipto) {
                            $shiptoObj = new \AppBundle\Entity\Shipto();
                            $shiptoObj->setName($shipto->getElementsByTagName('name')->item(0)->nodeValue);
                            $shiptoObj->setAddress($shipto->getElementsByTagName('address')->item(0)->nodeValue);
                            $shiptoObj->setCity($shipto->getElementsByTagName('city')->item(0)->nodeValue);
                            $shiptoObj->setCountry($shipto->getElementsByTagName('country')->item(0)->nodeValue);
                            $em->persist($shiptoObj);
                            $em->flush();

//                            $shiporderObj->setShiptoid($shiptoObj->getShiptoid());
                            $shiptoObj->getShiporders()->add($shiporderObj);
                            $shiporderObj->setShipto($shiptoObj);
                            $em->persist($shiporderObj);
                            $em->flush();
                        }

                        $items = $shiporder->getElementsByTagName('item');
                        foreach ($items as $item) {
                            $itemObj = new \AppBundle\Entity\Item();
//                            $itemObj->setOrderid($shiporderObj->getOrderid());
                            $itemObj->setTitle($item->getElementsByTagName('title')->item(0)->nodeValue);
                            $itemObj->setNote($item->getElementsByTagName('note')->item(0)->nodeValue);
                            $itemObj->setQuantity($item->getElementsByTagName('quantity')->item(0)->nodeValue);
                            $itemObj->setPrice($item->getElementsByTagName('price')->item(0)->nodeValue);


                            $shiporderObj->getItems()->add($itemObj);
                            $itemObj->setShiporder($shiporderObj);
                            $em->persist($itemObj);
                            $em->flush();
                        }
                    }
                }
            }
            $em->getConnection()->commit();
            return $shiporders;
        } catch (\Exception $exc) {
            $em->getConnection()->rollBack();
        }
    }

}
