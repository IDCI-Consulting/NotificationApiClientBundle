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

How to use it
=============

The gold of this bundle is to call services of the NotificationBundle, see the link below :

https://github.com/IDCI-Consulting/NotificationBundle

Send notifications:
-------------------

To send notification see the below example

Example of usage
----------------

```php
<?php
// Inside your controller

$this->get('service_name')->notify(array(
    /**
     * case 1 : email notification
     */
    "email" => array(
        "to" => array("to1@mail.com", "to2@mail.com", "to3@mail.com", "..."),
        "cc" => array("cc1@mail.com", "cc2@mail.com", "cc3@mail.com", "..."),
        "subject" => "Notification subject",
        "bcc" => array("bcc1@mail.com", "bcc2@mail.com", "bcc3@mail.com", "..."),
        "message" => "Notification Message",
        "attachements" => array()
    ),
    /**
     * case 2 : sms notification
     */
    "sms" => array(
        "to" => array("0612345678", "0610111213", "0610112214", "..."),
        "message" => "Notification Message"
    ),
    /**
     * case 3 : mail notification
     */
    "mail" => array(
        "to" => array(
            "firstName" => '',
            "lastName" => '',
            "address" => '',
            "postalCode" =>'',
            "city" => '',
            "country" => ''
        ),
        "message" => "Notification Message",
    ),
    /**
     * case 4 : facebook notification
     */
    "facebook" => array(
        "to" => array("user1@facebook.com", "user2@facebook.com", "user3@facebook.com", "..."),
        "message" => "Notification Message"
    ),
    /**
     * case 5 : twitter notification
     */
    "twitter" => array(
        "to" => array("user1@twitter.com", "user2@twitter.com", "user3@twitter.com", "..."),
        "message" => "Notification Message"
    )
));
```

