<?php
namespace Ppantelakis\BarCode\View\Helper\Factory;

use Ppantelakis\BarCode\View\Helper\BarCodeHelper;
use Zend\Mvc\Router\RouteStackInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;

/**
 * Class BarCodeHelperFactory
 * @author Ppantelakis Panagiotis
 * @link http://www.pantelakis.org
 */
class BarCodeHelperFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var HelperPluginManager $serviceLocator */
        $renderer = $serviceLocator->getServiceLocator()->has('viewrenderer') ?
                    $serviceLocator->getServiceLocator()->get('viewrenderer') :
                    new PhpRenderer();
        /** @var RouteStackInterface $router */
        $router = $serviceLocator->getServiceLocator()->get('router');
        return new BarCodeHelper($renderer, $router);
    }
}
