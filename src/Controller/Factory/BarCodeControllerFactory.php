<?php
namespace Ppantelakis\BarCode\Controller\Factory;

use Ppantelakis\BarCode\Controller\BarCodeController;
use Ppantelakis\BarCode\Service\BarCodeServiceInterface;
use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class BarCodeControllerFactory
 * @author
 * @link
 */
class BarCodeControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ControllerManager $serviceLocator */
        /** @var BarCodeServiceInterface $barCodeService */
        $barCodeService = $serviceLocator->getServiceLocator()->get('Ppantelakis\BarCode\Service\BarCodeService');
        return new BarCodeController($barCodeService);
    }
}
