## ZF2-PpBarCode

Installation11
------------

The preferred installation method is by using [composer](https://getcomposer.com). Just add this package to your composer.json

```json
{
    "require": {
        "ppantelakis/zf2-ppbarcode": "0.*"
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
    'Ppantelakis\BarCode' 
)
```

