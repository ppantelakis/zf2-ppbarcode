<?php
return array(

    'controllers' => array(
        'factories' => array(
            'Ppantelakis\BarCode\Controller\BarCode' => 'Ppantelakis\BarCode\Controller\Factory\BarCodeControllerFactory',
        )
    ),

    'router' => array(
        'routes' => array(

            'ppantelakis-barcode' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/bar-code/generate/:message/:barcodetype/:imagetype[/]',
                    'constraints' => array(
                        'barcodetype' => 'codabar|code128|code25|code25interleaved|code39|ean13|ean2|ean5|ean8|identcode|itf14|leitcode|planet|postnet|royalmail|upca|upce',
                        'imagetype' => 'png|jpeg|gif'
                    ),
                    'defaults' => array(
                        'controller' => 'Ppantelakis\BarCode\Controller\BarCode',
                        'action' => 'generate',
                        'message' => 'error',
                        'barcodetype' => 'error',
                        'imagetype' => 'png'
                    )
                )
            )

        )
    ),

    'service_manager' => array(
        'invokables' => array(
            'Ppantelakis\BarCode\Service\BarCodeService' => 'Ppantelakis\BarCode\Service\BarCodeService'
        )
    ),

    'view_helpers' => array(
        'factories' => array(
            'barCode' => 'Ppantelakis\BarCode\View\Helper\Factory\BarCodeHelperFactory',
        ),
    ),

    'view_manager' => array(
        'template_map' => array(
            'pantelakis/bar-code/image' => __DIR__ . '/../view/pantelakis/bar-code/image.phtml'
        )
    )

);
