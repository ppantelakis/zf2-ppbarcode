<?php
namespace Ppantelakis\BarCode\Service;

use Ppantelakis\BarCode\Exception\InvalidImagetypeException;
use Zend\Mvc\Controller\Plugin\Params;

/**
 * Interface BarCodeServiceInterface
 * @author Ppantelakis Panagiotis
 * @link http://www.pantelakis.org
 */
interface BarCodeServiceInterface
{
    const DEFAULT_MESSAGE = 'error';
    const DEFAULT_BARCODEKIND = 'error';
    const DEFAULT_IMAGETYPE      = 'png';

    /**
     * Generates the content-type corresponding to the provided extension
     * @param $barcodetype
     * @return string
     * @throws InvalidImagetypeException
     */
    public function generateImageType($barcodetype);

    /**
     * Returns a BarCode content to be rendered or saved
     * @param string|Params $messageOrParams
     * @param string $barcodetype
     * @param int $imagetype
     * @return mixed
     */
    public function getBarCodeContent(
        $messageOrParams,
        $barcodetype = self::DEFAULT_BARCODEKIND,
        $imagetype = self::DEFAULT_IMAGETYPE
    );
}
