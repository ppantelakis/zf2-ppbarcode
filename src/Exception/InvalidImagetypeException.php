<?php
namespace Ppantelakis\BarCode\Exception;

/**
 * Class InvalidImagetypeException
 * @author Ppantelakis Panagiotis
 * @link http://www.pantelakis.org
 */
class InvalidImagetypeException extends \Exception
{
    /**
     * @var array
     */
    private static $validImagetypes = array(
        'jpg',
        'jpeg',
        'png',
        'gif'
    );

    public static function getValidImagetypes()
    {
        return static::$validImagetypes;
    }

    public static function fromImagetype($imagetype)
    {
        return new self(sprintf(
            "Provided image type '%s' is not valid. Expected one of '%s'",
            $imagetype,
            implode("', '", static::getValidImagetypes())
        ));
    }
}
