NotificationClientApiBundle
===========================

Symfony2 notification client api bundle

Installation
============

To install this bundle please follow the next steps:

First add the dependency in your `composer.json` file:

```json
"require": {
    ...
    "idci/notification-client-api-bundle": "dev-master"
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
        new IDCI\Bundle\NotificationClientApiBundle\IDCINotificationClientApiBundle(),
    );
}
```
Now the Bundle is installed.

How to use it
=============

The gold of this bundle is to call services of the NotificationBundle, see the link below :

https://github.com/IDCI-Consulting/NotificationClientApiBundle

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
     * case 1 : notification email
     */
    "email" => array(
        "to" => array("adress1@test.com", "adresse2@test.com", "adresse3@test.com", "..."),
        "cc" => array("cc1@test.com", "cc2@test.com", "cc3@test.com", "..."),
        "subject" => "Notification subject",
        "bcc" => array("test1@test.com", "test2@test.com", "test3@test.com", "..."),
        "message" => "Notification Message",
        "attachements" => array()
    ),
    /**
     * case 2 : notification sms
     */
    "sms" => array(
        "to" => array("0612345678", "0610111213", "0610112214", "..."),
        "message" => "Notification Message"
    ),
    /**
     * case 3 : notification mail
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
    * case 4 : notification facebook
    */
    "facebook" => array(
        "to" => array("test1@facebook.com", "test2@facebook.com", "test3@facebook.com", "..."),
        "message" => "Notification Message"
    ),
    /**
     * case 5 : notification twitter
     */
    "twitter" => array(
        "to" => array("test1@twitter.com", "test2@twitter.com", "test3@twitter.com", "..."),
        "message" => "Notification Message"
    )
));

```





