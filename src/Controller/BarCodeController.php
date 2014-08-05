<?php

namespace Ppantelakis\BarCode\Controller;

use Ppantelakis\BarCode\Service\BarCodeServiceAwareInterface;
use Ppantelakis\BarCode\Service\BarCodeServiceInterface;
use Zend\Http\Response as HttpResponse;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class BarCodeController
 * @author Ppantelakis Panagiotis
 * @link http://www.pantelakis.org
 */
class BarCodeController extends AbstractActionController implements BarCodeServiceAwareInterface {

    /**
     * @var BarCodeServiceInterface
     */
    protected $barCodeService;

    public function __construct(BarCodeServiceInterface $barCodeService) {
        $this->barCodeService = $barCodeService;
    }

    /**
     * Generates the QR code and returns it as stream
     */
    public function generateAction() {
        
        
        $imagetype = $this->params()->fromRoute('imagetype', BarCodeServiceInterface::DEFAULT_IMAGETYPE);
        $content    = $this->barCodeService->getBarCodeContent($this->params());
        return $this->createResponse($content, $this->barCodeService->generateImageType($imagetype));
        
        
        



        

       // echo "<img src='data:image/" . $imagetype . ";base64," . base64_encode($contents) . "' />";

        //imagedestroy($imageResource);




        //$content = $this->barCodeService->getBarCodeContent($this->params());
        //return $this->createResponse($content, $this->barCodeService->generateImageType($barcodetype));
    }

    /**
     * Creates the response to be returned for a QR Code
     * @param $content
     * @param $imageType
     * @return HttpResponse
     */
    protected function createResponse($content, $imageType) {
        
        $resp = new HttpResponse();

        $resp->setStatusCode(200)
                ->setContent($content);
        $resp->getHeaders()->addHeaders(array(
            'Content-Length' => strlen($content),
            'Content-Type' => $imageType
        ));
        return $resp;
    }

    /**
     * @param BarCodeServiceInterface $barCodeService
     * @return void
     */
    public function setBarCodeService(BarCodeServiceInterface $barCodeService) {
        $this->barCodeService = $barCodeService;
    }

    /**
     * @return BarCodeServiceInterface
     */
    public function getBarCodeService() {
        return $this->barCodeService;
    }

}
