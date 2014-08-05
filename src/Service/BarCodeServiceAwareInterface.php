<?php
namespace Ppantelakis\BarCode\Service;

/**
 * Interface BarCodeServiceAwareInterface
 * @author Ppantelakis Panagiotis
 * @link http://www.pantelakis.org
 */
interface BarCodeServiceAwareInterface
{
    /**
     * @param BarCodeServiceInterface $barCodeService
     * @return void
     */
    public function setBarCodeService(BarCodeServiceInterface $barCodeService);

    /**
     * @return BarCodeServiceInterface
     */
    public function getBarCodeService();
}
