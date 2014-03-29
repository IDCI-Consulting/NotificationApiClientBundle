IDCINotificationApiClientBundle Notification
============================================


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
        "to" => array("to1@mail.com", "to2@mail.com", "to3@mail.com", "..."),
        "cc" => array("cc1@mail.com", "cc2@mail.com", "cc3@mail.com", "..."),
        "subject" => "Notification subject",
        "bcc" => array("bcc1@mail.com", "bcc2@mail.com", "bcc3@mail.com", "..."),
        "message" => "Notification Message",
        "htmlMessage" => "<h1>Titre</h1><p>message</p>",
        "attachements" => array()
    ))
    /**
     * case 2 : sms notification
     */
    ->addNotification("sms", array(
        "to" => array("0612345678", "0610111213", "0610112214", "..."),
        "message" => "Notification Message"
    ))
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
    ))
    /**
     * case 4 : facebook notification
     */
    ->addNotification("facebook", array(
        "to" => array("user1@facebook.com", "user2@facebook.com", "user3@facebook.com", "..."),
        "message" => "Notification Message"
    ))
    /**
     * case 5 : twitter notification
     */
    ->addNotification("twitter", array(
        "to" => array("user1@twitter.com", "user2@twitter.com", "user3@twitter.com", "..."),
        "message" => "Notification Message"
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
php app/console tms:notification:notify email '{"to":"test@email.fr","subject":"notification via command line","message":"message to send","htmlMessage":"<h1>Titre</h1><p>message</p>"}'
```
