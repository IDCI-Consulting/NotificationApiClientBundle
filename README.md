NotificationApiClientBundle
===========================

Symfony2 notification api client bundle

Installation
============

To install this bundle please follow the next steps:

First add the dependency in your `composer.json` file:

```json
"require": {
    ...
    "idci/notification-api-client-bundle": "dev-master"
},
```

Then install the bundle with the command:

```sh
php composer update
```

Enable the bundle in your application kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        //
        new IDCI\Bundle\NotificationApiClientBundle\IDCINotificationApiClientBundle(),
    );
}
```

Now the Bundle is installed.


Configure HTTP Client
=====================

The default Client
------------------

By default this bundle provide a simple HTTP Api Client, so you have to configure it.
So you just have to define the `endpoint_root` parameter in your `app/config/config.yml`.

```yml
idci_notification_api_client:
    default_http_client_parameters:
        endpoint_root: http|s://you.api.endpoint.root
```

Advanced Client
---------------

If you wish to use an advanced HTTP Api Client, we suggest the [DaApiClientBundle](https://github.com/Gnuckorg/DaApiClientBundle).

// TODO


How to use it
=============

This bundle is just an Api Client for the [NotificationBundle](https://github.com/IDCI-Consulting/NotificationBundle).
It simplify the webservice call.

To **send notification** you have to use the `notification_api_client.notifier` service.

```php
<?php
// Inside your controller

$this->get('notification_api_client.notifier')
    /**
     * case 1 : email notification
     */
    ->addNotification("email", array(
        "to" => array("to1@mail.com", "to2@mail.com", "to3@mail.com", "..."),
        "cc" => array("cc1@mail.com", "cc2@mail.com", "cc3@mail.com", "..."),
        "subject" => "Notification subject",
        "bcc" => array("bcc1@mail.com", "bcc2@mail.com", "bcc3@mail.com", "..."),
        "message" => "Notification Message",
        "attachements" => array()
    )),
    /**
     * case 2 : sms notification
     */
    ->addNotification("sms", array(
        "to" => array("0612345678", "0610111213", "0610112214", "..."),
        "message" => "Notification Message"
    )),
    /**
     * case 3 : mail notification
     */
    ->addNotification("mail", array(
        "to" => array(
            "firstName" => '',
            "lastName" => '',
            "address" => '',
            "postalCode" =>'',
            "city" => '',
            "country" => ''
        ),
        "message" => "Notification Message",
    )),
    /**
     * case 4 : facebook notification
     */
    ->addNotification("facebook" => array(
        "to" => array("user1@facebook.com", "user2@facebook.com", "user3@facebook.com", "..."),
        "message" => "Notification Message"
    )),
    /**
     * case 5 : twitter notification
     */
    ->addNotification("twitter" => array(
        "to" => array("user1@twitter.com", "user2@twitter.com", "user3@twitter.com", "..."),
        "message" => "Notification Message"
    ))
    ->notify()
));
```

