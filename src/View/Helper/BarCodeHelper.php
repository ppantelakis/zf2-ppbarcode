<?php
namespace Ppantelakis\BarCode\View\Helper;

use Ppantelakis\BarCode\View\Helper\BarCodeHelperInterface;
use Zend\Mvc\Router\RouteStackInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Renderer\RendererInterface;

/**
 * Class BarCodeHelper
 * @author Ppantelakis Panagiotis
 * @link http://www.pantelakis.org
 */
class BarCodeHelper extends AbstractHelper implements BarCodeHelperInterface
{
    /**
     * @var RendererInterface
     */
    protected $renderer;
    /**
     * @var RouteStackInterface
     */
    protected $router;
    /**
     * @var array
     */
    protected $routeOptions = array();

    public function __construct(RendererInterface $renderer, RouteStackInterface $router)
    {
        $this->renderer = $renderer;
        $this->router   = $router;
    }

    /**
     * Returns this if no params are provided, and returns a URL route otherwise
     * @param null $message
     * @param null $barcodetype
     * @param null $imagetype
     * @return $this|mixed
     */
    public function __invoke($message = null, $barcodetype = null, $imagetype = null)
    {
        if (count(func_get_args()) == 0 || (!isset($message) && !isset($barcodetype) && !isset($imagetype))) {
            return $this;
        }

        return $this->assembleRoute($message, $barcodetype, $imagetype);
    }

    /**
     * Renders a img tag pointing defined QR code
     * @param null $message
     * @param null $barcodetype
     * @param null $imagetype
     * @param array $attribs
     * @return string
     */
    public function renderImg($message = null, $barcodetype = null, $imagetype = null, $attribs = array())
    {
        return $this->renderer->render('pantelakis/bar-code/image', array(
            'src' => $this->assembleRoute($message, $barcodetype, $imagetype),
            'attribs' => $attribs
        ));
    }

    /**
     * Returns the assembled route as string
     * @param $message
     * @param null $barcodetype
     * @param null $imagetype
     * @return mixed
     */
    public function assembleRoute($message, $barcodetype = null, $imagetype = null)
    {
        $params = array('message' => $message);
        if (isset($barcodetype)) {
            $params['barcodetype'] = $barcodetype;
            if (isset($imagetype)) {
                $params['imagetype'] = $imagetype;
            }
        }

        $this->routeOptions['name'] = 'ppantelakis-barcode';
        return $this->router->assemble($params, $this->routeOptions);
    }

    /**
     * Allows you to set aditional options when creating the QR code route
     * @param array $routeOptions
     * @return $this
     */
    public function setRouteOptions(array $routeOptions)
    {
        $this->routeOptions = $routeOptions;
        return $this;
    }
}
