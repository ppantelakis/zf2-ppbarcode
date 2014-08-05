<?php

namespace Ppantelakis\BarCode\Exception;

/**
 * Class InvalidBarcodetypeException
 * @author Ppantelakis Panagiotis
 * @link http://www.pantelakis.org
 */
class InvalidBarcodetypeIException extends \Exception {

    /**
     * @var array
     */
    private static $validBarcodetypes = array(
        'codabar',
        'code128',
        'code25',
        'code25interleaved',
        'code39', 'ean13', 'ean2',
        'ean5',
        'ean8',
        'identcode',
        'itf14',
        'leitcode',
        'planet',
        'postnet',
        'royalmail',
        'upca',
        'upce'
    );

    public static function getValidBarcodetypes() {
        return static::$validBarcodetypes;
    }

    public static function fromImagetype($barcodetype) {
        return new self(sprintf(
                        "Provided barcode type '%s' is not valid. Expected one of '%s'", $barcodetype, implode("', '", static::getValidBarcodetypes())
        ));
    }

}
