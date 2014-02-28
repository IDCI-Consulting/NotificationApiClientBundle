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
Follow the documentation to install it.

Once done, configure your application in order to tell notification bundle to use it.
You must have at least one da_api_client_api defined:

```yml
# Da Api Client
da_api_client:
    api:
        notification:
            base_url:      %default_http_client_endpoint_root%
            cache_enabled: true
            client:
                service: notification_api_client.http_client.da
```

Here we have defined `da_api_client_api_notification` service.
To use this service with notification instead of the default one, change the 
`idci_notification_api_client_http_client` value as follow:

```yml
# Notification Api Client
idci_notification_api_client:
    http_client: da_api_client.api.notification
```

to check if every thing seem to be ok, you can execute this command:

```sh
php app/console container:debug
```

You'll get this result:

```sh
...
notification_api_client.http_client             n/a       alias for da_api_client.api.notification
...
```

instead of the default:

```sh
...
notification_api_client.http_client             n/a       alias for notification_api_client.http_client.default
...
```


How to use it
=============

This bundle is just an Api Client for the [NotificationBundle](https://github.com/IDCI-Consulting/NotificationBundle).
It simplify the webservice call.

Using the service
-----------------

To **send notification** you have to use the `notification_api_client.notifier` service.

```php
$this->get('notification_api_client.notifier')
    /**
     * case 1 : email notification
     */
    ->addNotification("email", array(
        'to' => array(
                'to'  => array("to1@mail.com", "to2@mail.com", "to3@mail.com", "..."),
                'cc'  => array("cc1@mail.com", "cc2@mail.com", "cc3@mail.com", "..."),
                'bcc' => array("bcc1@mail.com", "bcc2@mail.com", "bcc3@mail.com", "...")
            ),
        'from' => array(
                'login'      => "login@tessi.com",
                'password'   => "titi",
                'server'     => "smtp.tessi.fr",
                'port'       => "465",
                'encryption' => "ssl",
                'isSecured'  => "yes"
            ),
        'content' => array(
                'subject'     => "Notification subject",
                'message'     => "Notification Message",
                'htmlMessage' => "<h1>Titre</h1><p>message</p>",
                'attachments' => array()
            )
    ))
    /**
     * case 2 : sms notification
     */
    ->addNotification("sms", array(
        'to' => array(
            'to' => array("0612345678", "0610111213", "0610112214", "...")
        ),
        'from' => array(
            'from' => "0653214862"
        ),
        'content' array(
            'message' => "Notification Message")
        )
    ))
    /**
     * case 3 : mail notification
     */
    ->addNotification("mail", array(
        'to' => array(
            'firstName'  => "Titi",
            'lastName'   => "Tutu",
            'address'    => "Titis adresse",
            'postalCode' =>"75002",
            'city'       => "Paris",
            'country'    => "FR"
        ),
        'from' => array(
            'senderFirstName'  => "sender's first name",
            'senderLastName'   => "sender's last name",
            'senderAddress'    => "sender's adresse",
            'senderPostalCode' => "75001",
            'senderCity'       => "Paris",
            'senderCountry'    => "FR"
        ),
        'content' => array(
            'message' => "Message to send"
        )
    ))
    /**
     * case 4 : facebook notification
     */
    ->addNotification("facebook", array(
        'to' => array(
            'to' => "henri@facebook.com"
        ),
        'from' => array(
            'senderLogin'    => "Titi22",
            'senderPassword' => "password"
        ),
        'content' => array(
            'message' => "Notification message"
        )
    ))
    /**
     * case 5 : twitter notification
     */
    ->addNotification("twitter", array(
        'to' => array(
            'to' => array("user1@twitter.com", "user2@twitter.com", "user3@twitter.com", "...")
        ),
        'from' => array(
            'senderLogin'    => "userx@twitter.com",
            'senderPassword' => "password"
        ),
        'content' => array(
            'message' => "Notification message"
        )
    ))
    ->notify()
));
```

Using the command line
----------------------

You can use directly the command if you wish to send notification with a cron for example.
To do that use the **tms:notification:notify type parameters** command.
You just have to specify the mandatory arguments.

The first one is the type such as email, mail, sms, twitter or facebook.

The second one are the parameters (in json format) according to the given type.

Below an example of usage

```sh
php app/console tms:notification:notify email '{"to": {"to": "test@email.fr", "cc": "titi@toto.fr, tutu@titi.fr", "bcc": null}, "from": {"login":"sender@tessi.com", "password": "password", "server": "smtp.tessi.fr", "port": "465", "encryption": "ssl", "isSecured": "yes"},"content": {"subject": "notification via command line", "message": "the message to be send", "htmlMessage": "<h1>Titre</h1><p>Message</p>", "attachments": []}}'
```