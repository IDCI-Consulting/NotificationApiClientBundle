NotificationApiClientBundle
===========================

Symfony2 notification api client bundle


Installation
------------

Add dependencies in your `composer.json` file:
```json
"require": {
    ...
    "da/api-client-bundle": "dev-master",
    "idci/notification-api-client-bundle": "dev-master"
},
```

Install these new dependencies of your application:
```sh
$ php composer update
```

Enable the bundle in your application kernel:
```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Da\ApiClientBundle\DaApiClientBundle(),
        new IDCI\Bundle\NotificationApiClientBundle\IDCINotificationApiClientBundle(),
    );
}
```

Import the bundle configuration:
```yml
# app/config/config.yml

imports:
    - { resource: @IDCINotificationApiClientBundle/Resources/config/config.yml }
```

To check if every thing seem to be ok, you can execute this command:
```sh
$ php app/console container:debug
```

You'll get this result:
```sh
...
da_api_client.api.notification    container Da\ApiClientBundle\Http\Rest\RestApiClientBridge
...
```


Documentation
-------------

[Read the Documentation](Resources/doc/index.md)


Tests
-----

Install bundle dependencies:
```sh
$ php composer.phar update
```

To execute unit tests:
```sh
$ phpunit --coverage-text
```
