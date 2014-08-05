<?php
namespace Ppantelakis\BarCode\View\Helper;

/**
 * Interface BarCodeHelperInterface
 * @author Ppantelakis Panagiotis
 * @link http://www.pantelakis.org
 */
interface BarCodeHelperInterface
{
    /**
     * Returns this if no params are provided, and returns a URL route otherwise
     * @param null $message
     * @param null $barcodetype
     * @param null $imagetype
     * @return $this|mixed
     */
    public function __invoke($message = null, $barcodetype = null, $imagetype = null);

    /**
     * Renders a img tag pointing defined QR code
     * @param null $message
     * @param null $barcodetype
     * @param null $imagetype
     * @param array $attribs
     * @return string
     */
    public function renderImg($message = null, $barcodetype = null, $imagetype = null, $attribs = array());

    /**
     * Returns the assembled route as string
     * @param $message
     * @param null $barcodetype
     * @param null $imagetype
     * @return mixed
     */
    public function assembleRoute($message, $barcodetype = null, $imagetype = null);

    /**
     * Allows you to set aditional options when creating the QR code route
     * @param array $routeOptions
     * @return $this
     */
    public function setRouteOptions(array $routeOptions);
}
