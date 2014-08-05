<?php

namespace Ppantelakis\BarCode\Service;

use Ppantelakis\BarCode\Exception\InvalidImagetypeException;
use Zend\Mvc\Controller\Plugin\Params;
use Zend\Barcode\Barcode;

/**
 * Class BarCodeService
 * @author Ppantelakis Panagiotis
 * @link http://www.pantelakis.org
 */
class BarCodeService implements BarCodeServiceInterface {

    /**
     * Generates the content-type corresponding to the provided extension
     * @param $imagetype
     * @return string
     * @throws InvalidImagetypeException
     */
    public function generateImageType($imagetype) {
        if (!in_array($imagetype, InvalidImagetypeException::getValidImagetypes())) {
            throw InvalidImagetypeException::fromImagetype($imagetype);
        }

        return sprintf('image/%s', $imagetype == self::DEFAULT_IMAGETYPE ? 'png' : $imagetype);
    }

    /**
     * Returns a BarCode content to be rendered or saved
     * @param string|Params $messageOrParams
     * @param string $barcodetype
     * @param int $imagetype
     * @return mixed
     */
    public function getBarCodeContent($messageOrParams, $barcodetype = self::DEFAULT_BARCODEKIND, $imagetype = self::DEFAULT_IMAGETYPE) {
        if ($messageOrParams instanceof Params) {

            $barcodetype = $messageOrParams->fromRoute('barcodetype', BarCodeServiceInterface::DEFAULT_BARCODEKIND);
            $imagetype = $messageOrParams->fromRoute('imagetype', BarCodeServiceInterface::DEFAULT_IMAGETYPE);
            $messageOrParams = $messageOrParams->fromRoute('message', BarCodeServiceInterface::DEFAULT_MESSAGE);
        }

        $barcodeOptions = array('text' => $messageOrParams);
        $rendererOptions = array();

// Draw the barcode in a new image,
        $imageResource = Barcode::draw(
                        $barcodetype, 'image', $barcodeOptions, $rendererOptions
        );
        ob_start();
        if ($imagetype == 'jpeg') {
            imagejpeg($imageResource);
        } else if ($imagetype == 'gif') {
            imagegif($imageResource);
        } else {
            imagepng($imageResource);
        }
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }

}
