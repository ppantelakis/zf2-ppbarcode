## ZF2-PpBarCode

[![Build Status](https://travis-ci.org/pantelakis/ZF2-PpBarCode.svg?branch=develop)](https://travis-ci.org/pantelakis/ZF2-PpBarCode)
[![Code Coverage](https://scrutinizer-ci.com/g/pantelakis/ZF2-PpBarCode/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/pantelakis/ZF2-PpBarCode/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pantelakis/ZF2-PpBarCode/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pantelakis/ZF2-PpBarCode/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/pantelakis/zf2-ppbarcode/v/stable.png)](https://packagist.org/packages/pantelakis/zf2-ppbarcode)
[![Total Downloads](https://poser.pugx.org/pantelakis/zf2-ppbarcode/downloads.png)](https://packagist.org/packages/pantelakis/zf2-ppbarcode)
[![License](https://poser.pugx.org/pantelakis/zf2-ppbarcode/license.png)](https://packagist.org/packages/pantelakis/zf2-ppbarcode)

This Zend Framework 2 module allows you to easily generate QR codes by using the [Endroid QR Code](https://github.com/endroid/BarCode) library, by [Endroid](https://github.com/endroid).

It has been based on the [EndroidBarCodeBundle](https://github.com/endroid/EndroidBarCodeBundle) Symfony bundle.

Installation
------------

The preferred installation method is by using [composer](https://getcomposer.com). Just add this package to your composer.json

```json
{
    "require": {
        "pantelakis/zf2-ppbarcode": "0.*"
    }
}
```
and update your dependencies with composer `php composer.phar update`

After that you just need to add the module to the list of enabled modules in you `application.config.php` file

```php
'modules' => array(
    'Application',
    'ZfcUser',
    'ZfcBase',
    'Ppantelakis\BarCode' // <-- This line will do the job
)
```

Usage
-----

The module can be used in many ways. It includes a route which points to a controller which returns the QR code image as a response.

You can simply use that route to create your own QR codes by passing three simple arguments. The message to be encoded, the extension of the image (jpg, png or gif) and the imagetype of the image.

In your view template do something like this.

```php
<img src="<?php echo $this->url('ppantelakis-barcode', ['message' => 'This is a QR code example']) ?>">
<img src="<?php echo $this->url('ppantelakis-barcode', ['message' => 'Another QR code', 'extension' => 'gif']) ?>">
<img src="<?php echo $this->url('ppantelakis-barcode', ['message' => 'Something bigger', 'extension' => 'png', 'imagetype' => '600']) ?>">
```

By default the extension is jpg, and the imagetype is 200. The message has to be provided.

#### The view helper

To ease that task, a view helper is provided. By using it you can directly render img tags pointing to that QR code or just get the assembled route just like you would do with the `url` view helper.

```php
<?php echo $this->barCode()->renderImg('The message', 'png'); ?>
```

This will produce this image

```html
<img src="/bar-code/generate/The%20message.png">
```

If you need aditional attributes in the img tag, the fourth argument is an array with the attributes and their values.

```php
<?php echo $this->barCode()->renderImg('The message', 'png', '300', ['title' => 'This is a cool QR code', 'class' => 'img-thumbnail']); ?>
```

This will produce this image

```html
<img src="/bar-code/generate/The%20message.png/300" title="This is a cool QR code" class="img-thumbnail">
```

If your application is XHTML, the image tag will automatically be closed with `/>`. If it is HTML5 it will be closed with just `>`

If you just need to get the route, this view helper is a shortcut to the `url` view helper if you use it like this.

```php
<div>
    <h2>This is a nice title</h2>
    <div style="background: url(<?php echo $this->barCode('The message', 'png') ?>);"></div>
</div>
```

If you need aditional route options to be used, it can be done like this.

```php
<div>
    <h2>This is a nice title</h2>
    <div style="background: url(<?php echo $this->barCode()->setRouteOptions(['force_canonical' => true])->assembleRoute('The message', 'png') ?>);"></div>
</div>
```

#### The service

If that view helper does not fit your needs, or you need to do something else with the QR codes, like saving them to some storage system, you can directly use the `BarCodeService`.

It has been registered with the key `Ppantelakis\BarCode\Service\BarCodeService` in order for you to inject it to any of your own services.

The returned object is a `Ppantelakis\BarCode\Service\BarCodeService` which implements `Ppantelakis\BarCode\Service\BarCodeServiceInterface`.

```php
/** @var \Zend\ServiceManager\ServiceLocatorInterface $sm */
$service = $sm->get('Ppantelakis\BarCode\Service\BarCodeService');
$content = $service->getBarCodeContent('http://www.pantelakis.org/', 'png');

// Save the image to disk
file_put_contents('/path/to/file.png', $content);
```

Testing
-------

This module includes all its unit tests and follows dependency injection and abstraction for you to be able to test any component that depend on its classes.

