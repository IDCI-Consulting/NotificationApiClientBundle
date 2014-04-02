IDCINotificationApiClientBundle Notification
============================================

How to use it
=============

This bundle is just an Api Client for the [NotificationBundle](https://github.com/IDCI-Consulting/NotificationBundle).
It simplify the webservice call.

Using the service
-----------------

To **send notification** you have to use the `notification_api_client.notifier` service.

### Email notification

#### Field "notifierAlias" :

| Optional | Requirements | Description
|----------|--------------|------------
| true     | string value | The notifier alias used to identify a configuration

#### Field "to" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| to          | false    | string value | Email delivery address
| cc          | true     | string value | Carbon copy adresses
| bcc         | true     | string value | Blind carbon copy addresses

#### Field "from" :

| Subfield    | Optional | Requirements         | Description
|-------------|----------|----------------------|------------
| transport   | true     | smtp, sendmail, mail | Transport data
| from        | true     | string value         | Sender email address
| login       | true     | string value         | Login data
| password    | true     | string value         | Password data
| server      | true     | string value         | Server data
| port        | true     | 0 <= value <= 65536  | Port data
| encryption  | true     | null, ssl, tls       | Encryption data

#### Field "content" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| subject     | false    | string value | Subject data
| message     | true     | string value | Email message
| htmlMessage | true     | string value | Email message in html format
| attachments | true     | string value | Attachments data

#### Case 1 : notification with notifier parameters
```php
$this->get('notification_api_client.notifier')
    ->addNotification("email", array(
        "to" => array(
            "to"  => "to1@mail.com, to2@mail.com, to3@mail.com",
            "cc"  => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
            "bcc" => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com"
        ),
        "from" => array(
            "transport"  => "smtp",
            "from"       => "test@test.fr",
            "login"      => "mail@mxserver.com",
            "password"   => "password",
            "server"     => "smtp.mxserver.fr",
            "port"       => "465",
            "encryption" => "ssl"
        ),
        "content" => array(
            "subject"      => "Notification subject",
            "message"      => "Notification Message",
            "htmlMessage"  => "<h1>Titre</h1><p>message</p>",
            "attachments"  => array()
        )
    ))
    ->notify()
;
```
#### Case 2 : notification without notifier parameters
```php
$this->get('notification_api_client.notifier')
    ->addNotification("email", array(
        "notifierALias" => "my_email_alias",
        "to" => array(
            "to"  => "to1@mail.com, to2@mail.com, to3@mail.com",
            "cc"  => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
            "bcc" => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com"
        ),
        "content" => array(
            "subject"      => "Notification subject",
            "message"      => "Notification Message",
            "htmlMessage"  => "<h1>Titre</h1><p>message</p>",
            "attachments"  => array()
        )
    ))
    ->notify()
;
```

### Sms

#### Field "notifierAlias" :

| Optional | Requirements | Description
|----------|--------------|------------
| true     | string value | The notifier alias used to define a configuration

#### Field "to" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| to          | false    | string value | Recipient phone number

#### Field "from" :

| Subfield     | Optional | Requirements | Description
|--------------|----------|--------------|------------
| phoneNumber  | true     | 0 <= value   | Sender phone number

#### Field "content" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| message     | true     | string value | Message data

#### Case 1 : notification with notifier parameters
```php
$this->get('notification_api_client.notifier')
    ->addNotification("sms", array(
        "to" => array(
            "to" => "0612345678, 0610111213, 0610112214"
        ),
        "from" => array(
            "phoneNumber" => "0625415878"
        ),
        "content" => array(
            "message" => "Notification Message"
        )
    ))
    ->notify()
;
```

#### Case 2 : notification without notifier parameters
```php
$this->get('notification_api_client.notifier')
    ->addNotification("sms", array(
        "notifierALias" => "my_sms_alias",
        "to" => array(
            "to" => "0612345678, 0610111213, 0610112214"
        ),
        "content" => array(
            "message" => "Notification Message"
        )
    ))
    ->notify()
;
```

### Mail

#### Field "notifierAlias" :

| Optional | Requirements | Description
|----------|--------------|------------
| true     | string value | The notifier alias used to define a configuration

#### Field "to" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| firstName   | false    | string value | Recipient first name
| lastName    | false    | string value | Recipient last name
| address     | false    | string value | Recipient address
| postalCode  | false    | 0 <= value   | Recipient postal code
| city        | false    | string value | Recipient city
| country     | false    | string value | Recipient country (for France, use FR)

#### Field "from" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|-------------
| firstName   | true     | string value | Sender first name
| lastName    | true     | string value | Sender last name
| address     | true     | string value | Sender address
| postalCode  | true     | 0 <= value   | Sender postal code
| city        | true     | string value | Sender city
| country     | true     | string value | Sender country (for France, use FR)

#### Field "content" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| message     | true     | string value | Message data

#### Case 1 : notification with notifier parameters
```php
$this->get('notification_api_client.notifier')
    ->addNotification("mail", array(
        "to" => array(
            "firstName"  => 'fName',
            "lastName"   => 'lName',
            "address"    => 'address',
            "postalCode" => '75001',
            "city"       => 'Paris',
            "country"    => 'FR'
        ),
        "from" => array(
            "firstName"  => 'senderFirstName',
            "lastName"   => 'senderLastName',
            "address"    => 'senderAddress',
            "postalCode" => '75001',
            "city"       => 'Paris',
            "country"    => 'FR'
        ),
        "content" => array(
            "message" => "Notification Message"
        )
    ))
    ->notify()
;
```
#### Case 2 : notification without notifier parameters
```php
$this->get('notification_api_client.notifier')
    ->addNotification("mail", array(
        "notifierAlias" => "my_mail_alias",
        "to" => array(
            "firstName"  => 'fName',
            "lastName"   => 'lName',
            "address"    => 'address',
            "postalCode" => '75001',
            "city"       => 'Paris',
            "country"    => 'FR'
        ),
        "content" => array(
            "message" => "Notification Message",
        )
    ))
    ->notify()
;
```

### Facebook

#### Field "notifierAlias" :

| Optional | Requirements | Description
|----------|--------------|------------
| true     | string value | The notifier alias used to define a configuration

#### Field "to" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| to          | false    | string value | Facebook delivery address

#### Field "from" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| login       | true     | string value | Login data
| password    | true     | string value | Password data

#### Field "content" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| message     | true     | string value | Message data

#### Case 1 : notification with notifier parameters
```php
$this->get('notification_api_client.notifier')
    ->addNotification("facebook", array(
        "to" => array(
            "to" => "user1@facebook.com, user2@facebook.com"
        ),
        "from" => array(
            "login"    => "mylogin@facebook.com",
            "password" => "mypassword"
        ),
        "content" => array(
            "message" => "Notification Message"
        )
    ))
    ->notify()
;
```
#### Case 2 : notification without notifier parameters
```php
$this->get('notification_api_client.notifier')
    ->addNotification("facebook", array(
        "notifierAlias" => "my_facebook_alias",
        "to" => array(
            "to" => "user1@facebook.com, user2@facebook.com"
        ),
        "content" => array(
            "message" => "Notification Message"
        )
    ))
    ->notify()
;
```

### Twitter
#### Field "notifierAlias" :

| Optional | Requirements | Description
|----------|--------------|------------
| true     | string value | The notifier alias used to define a configuration

#### Field "to" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| to          | false    | string value | Recipient twitter address

#### Field "from" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| login       | true     | string value | Login data
| password    | true     | string value | Password data

#### Field "content" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| message     | true     | string value | Message data


#### Case 1 : notification with notifier parameters
```php
$this->get('notification_api_client.notifier')
    ->addNotification("facebook", array(
        "to" => array(
            "to" => "@user1, @user2"
        ),
        "from" => array(
            "login"    => "@mylogin",
            "password" => "mypassword"
        ),
        "content" => array(
            "message" => "Notification Message"
        )
    ))
    ->notify()
;
```
#### Case 2 : notification without notifier parameters
```php
$this->get('notification_api_client.notifier')
    ->addNotification("facebook", array(
        "notifierAlias" => "my_twitter_alias",
        "to" => array(
            "to" => "@user1, @user2"
        ),
        "content" => array(
            "message" => "Notification Message"
        )
    ))
    ->notify()
;
```
### Examples :

#### To send one email notification :
Note : notification with notifier parameters
```php
$this->get('notification_api_client.notifier')
    ->addNotification("email", array(
        "to" => array(
            "to"  => "to1@mail.com, to2@mail.com, to3@mail.com",
            "cc"  => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
            "bcc" => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com"
        ),
        "from" => array(
            "transport"  => "smtp",
            "from"       => "test@test.fr",
            "login"      => "mail@mxserver.com",
            "password"   => "password",
            "server"     => "smtp.mxserver.fr",
            "port"       => "465",
            "encryption" => "ssl"
        ),
        "content" => array(
            "subject"      => "Notification subject",
            "message"      => "Notification Message",
            "htmlMessage"  => "<h1>Titre</h1><p>message</p>",
            "attachments"  => array()
        )
    ))
    ->notify()
;
```
#### To send two email notifications :
```php
$this->get('notification_api_client.notifier')
    ->addNotification("email", array(
        array(
            "to" => array(
                "to"  => "to1@mail.com, to2@mail.com, to3@mail.com",
                "cc"  => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
                "bcc" => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com"
            ),
            "from" => array(
                "transport"  => "smtp",
                "from"       => "test@test.fr",
                "login"      => "mail@mxserver.com",
                "password"   => "password",
                "server"     => "smtp.mxserver.fr",
                "port"       => "465",
                "encryption" => "ssl"
            ),
            "content" => array(
                "subject"      => "Notification subject",
                "message"      => "Notification Message",
                "htmlMessage"  => "<h1>Titre</h1><p>message</p>",
                "attachments"  => array()
            )
        ),
        array(
            "notifierAlias" => "my_email_alias",
            "to" => array(
                "to"  => "to1@mail.com, to2@mail.com, to3@mail.com",
                "cc"  => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
                "bcc" => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com"
            ),
            "content" => array(
                "subject"      => "Notification subject",
                "message"      => "Notification Message",
                "htmlMessage"  => "<h1>Titre</h1><p>message</p>",
                "attachments"  => array()
            )
        )
    ))
    ->notify()
;
```
#### To send two email and one sms notifications :
```php
$this->get('notification_api_client.notifier')
    ->addNotification("email", array(
        array(
            "to" => array(
                "to"  => "to1@mail.com, to2@mail.com, to3@mail.com",
                "cc"  => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
                "bcc" => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com"
            ),
            "from" => array(
                "transport"  => "smtp",
                "from"       => "test@test.fr",
                "login"      => "mail@mxserver.com",
                "password"   => "password",
                "server"     => "smtp.mxserver.fr",
                "port"       => "465",
                "encryption" => "ssl"
            ),
            "content" => array(
                "subject"      => "Notification subject",
                "message"      => "Notification Message",
                "htmlMessage"  => "<h1>Titre</h1><p>message</p>",
                "attachments"  => array()
            )
        ),
        array(
            "notifierAlias" => "my_email_alias",
            "to" => array(
                "to"  => "to1@mail.com, to2@mail.com, to3@mail.com",
                "cc"  => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
                "bcc" => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com"
            ),
            "content" => array(
                "subject"      => "Notification subject",
                "message"      => "Notification Message",
                "htmlMessage"  => "<h1>Titre</h1><p>message</p>",
                "attachments"  => array()
            )
        )
    ))
    ->addNotification("sms", array(
        "to" => array(
            "to" => "0612345678, 0610111213, 0610112214"
        ),
        "from" => array(
            "phoneNumber" => "0625415878"
        ),
        "content" => array(
            "message" => "Notification Message"
        )
    ))
    ->notify()
;
```

Using the command line
----------------------

You can use directly the command if you wish to send notification with a cron for example.
To do that use the **tms:notification:notify type parameters** command.
You just have to specify the mandatory arguments.

The first one is the type such as email, mail, sms, twitter or facebook.

The second one are the parameters (in json format) according to the given type.

Below an example of usage
Case 1 : notification with notifier parameters
```sh
php app/console tms:notification:notify email '{"to":{"to":"to1@mail.com, to2@mail.com","cc":"cc1@mail.com, cc2@mail.com","bcc":"bcc1@mail.com, bcc2@mail.com"},"from":{"transport":"smtp","from":"test@test.fr","login":"mail@mxserver.com","password":"password","server":"smtp.mxserver.fr","port":"465","encryption":"ssl"},"content":{"subject":"Notification subject","message":"Notification Message","htmlMessage":"<h1>Titre<\/h1><p>message<\/p>","attachments":[]}}'
```
Case 2 : notification with notifier parameters
```sh
php app/console tms:notification:notify email '{"notifierAlias":"my_email_alias","to":{"to":"to1@mail.com, to2@mail.com, to3@mail.com","cc":"cc1@mail.com, cc2@mail.com, cc3@mail.com","bcc":"bcc1@mail.com, bcc2@mail.com, bcc3@mail.com"},"content":{"subject":"Notification subject","message":"Notification Message","htmlMessage":"<h1>Titre<\/h1><p>message<\/p>","attachments":[]}}'
```