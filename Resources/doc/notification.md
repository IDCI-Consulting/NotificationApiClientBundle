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
| replyTo     | true     | string value         | Email address to reply
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

#### Results
The function `notify()` returns a response from an API Client.

| Response values | Meaning
|-----------------|--------
| true            | The notification has been sent.
| false           | The notification has not been sent.

#### Case 1 : notification with notifier parameters
```php
$response1 = $this->get('notification_api_client.notifier')
    ->addNotification("email", array(
        "to"          => "to1@mail.com, to2@mail.com, to3@mail.com",
        "cc"          => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
        "bcc"         => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com",
        "transport"   => "smtp",
        "replyTo"     => "replyto@test.fr",
        "from"        => "test@test.fr",
        "login"       => "mail@mxserver.com",
        "password"    => "password",
        "server"      => "smtp.mxserver.fr",
        "port"        => 465,
        "encryption"  => "ssl",
        "subject"     => "Notification subject",
        "message"     => "Notification Message",
        "htmlMessage" => "<h1>Titre</h1><p>message</p>",
        "attachments" => array()
    ))
    ->notify()
;
```
#### Case 2 : notification without notifier parameters
```php
$response2 = $this->get('notification_api_client.notifier')
    ->addNotification("email", array(
        "notifierALias" => "my_email_alias",
        "to"            => "to1@mail.com, to2@mail.com, to3@mail.com",
        "cc"            => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
        "bcc"           => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com",
        "subject"       => "Notification subject",
        "message"       => "Notification Message",
        "htmlMessage"   => "<h1>Titre</h1><p>message</p>",
        "attachments"   => array()
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

| Subfield      | Optional | Requirements | Description
|---------------|----------|--------------|------------
| toPhoneNumber | false    | string value | Recipient phone number

#### Field "from" :

| Subfield        | Optional | Requirements | Description
|-----------------|----------|--------------|------------
| fromPhoneNumber | true     | string value | Sender phone number

#### Field "content" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| message     | true     | string value | Message data

#### Results
The function `notify()` returns a response from an API Client.

| Response values | Meaning
|-----------------|--------
| true            | The notification has been sent.
| false           | The notification has not been sent.

#### Case 1 : notification with notifier parameters
```php
$response1 = $this->get('notification_api_client.notifier')
    ->addNotification("sms", array(
        "toPhoneNumber"   => "0612345678, 0610111213, 0610112214",
        "fromPhoneNumber" => "0625415878",
        "message"         => "Notification Message"
    ))
    ->notify()
;
```

#### Case 2 : notification without notifier parameters
```php
$response2 = $this->get('notification_api_client.notifier')
    ->addNotification("sms", array(
        "notifierALias" => "my_sms_alias",
        "toPhoneNumber" => "0612345678, 0610111213, 0610112214",
        "message"       => "Notification Message"
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

| Subfield     | Optional | Requirements | Description
|--------------|----------|--------------|------------
| toFirstName  | false    | string value | Recipient first name
| toLastName   | false    | string value | Recipient last name
| toAddress    | false    | string value | Recipient address
| toPostalCode | false    | string value | Recipient postal code
| toCity       | false    | string value | Recipient city
| toCountry    | false    | string value | Recipient country (for France, use FR)

#### Field "from" :

| Subfield       | Optional | Requirements | Description
|----------------|----------|--------------|-------------
| fromFirstName  | true     | string value | Sender first name
| fromLastName   | true     | string value | Sender last name
| fromAddress    | true     | string value | Sender address
| fromPostalCode | true     | string value | Sender postal code
| fromCity       | true     | string value | Sender city
| fromCountry    | true     | string value | Sender country (for France, use FR)

#### Field "content" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| message     | true     | string value | Message data

#### Results
The function `notify()` returns a response from an API Client.

| Response values | Meaning
|-----------------|--------
| true            | The notification has been sent.
| false           | The notification has not been sent.

#### Case 1 : notification with notifier parameters
```php
$response1 = $this->get('notification_api_client.notifier')
    ->addNotification("mail", array(
        "toFirstName"    => "fName",
        "toLastName"     => "lName",
        "toAddress"      => "address",
        "toPostalCode"   => "75001",
        "toCity"         => "Paris",
        "toCountry"      => "FR",
        "fromFirstName"  => "senderFirstName",
        "fromLastName"   => "senderLastName",
        "fromAddress"    => "senderAddress",
        "fromPostalCode" => "75001",
        "fromCity"       => "Paris",
        "fromCountry"    => "FR",
        "message"        => "Notification Message"
    ))
    ->notify()
;
```
#### Case 2 : notification without notifier parameters
```php
$response2 = $this->get('notification_api_client.notifier')
    ->addNotification("mail", array(
        "notifierAlias" => "my_mail_alias",
        "toFirstName"   => "fName",
        "toLastName"    => "lName",
        "toAddress"     => "address",
        "toPostalCode"  => "75001",
        "toCity"        => "Paris",
        "toCountry"     => "FR",
        "message"       => "toto"
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

#### Results
The function `notify()` returns a response from an API Client.

| Response values | Meaning
|-----------------|--------
| true            | The notification has been sent.
| false           | The notification has not been sent.

#### Case 1 : notification with notifier parameters
```php
$response1 = $this->get('notification_api_client.notifier')
    ->addNotification("facebook", array(
        "to"       => "user1@facebook.com, user2@facebook.com",
        "login"    => "mylogin@facebook.com",
        "password" => "mypassword",
        "message"  => "Notification Message"
    ))
    ->notify()
;
```
#### Case 2 : notification without notifier parameters
```php
$response2 = $this->get('notification_api_client.notifier')
    ->addNotification("facebook", array(
        "notifierAlias" => "my_facebook_alias",
        "to"            => "user1@facebook.com, user2@facebook.com",
        "message"       => "Notification Message"
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

#### Results
The function `notify()` returns a response from an API Client.

| Response values | Meaning
|-----------------|--------
| true            | The notification has been sent.
| false           | The notification has not been sent.

#### Case 1 : notification with notifier parameters
```php
$response1 = $this->get('notification_api_client.notifier')
    ->addNotification("twitter", array(
        "to"       => "@user1, @user2",
        "login"    => "@mylogin",
        "password" => "mypassword",
        "message"  => "Notification Message"
    ))
    ->notify()
;
```
#### Case 2 : notification without notifier parameters
```php
$response2 = $this->get('notification_api_client.notifier')
    ->addNotification("twitter", array(
        "notifierAlias" => "my_twitter_alias",
        "to"            => "@user1, @user2",
        "message"       => "Notification Message"
    ))
    ->notify()
;
```
### Examples :

#### To send one email notification :
Note : notification with notifier parameters
```php
$response = $this->get('notification_api_client.notifier')
    ->addNotification("email", array(
        "to"          => "to1@mail.com, to2@mail.com, to3@mail.com",
        "cc"          => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
        "bcc"         => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com",
        "transport"   => "smtp",
        "replyTo"     => "replyto@test.fr",
        "from"        => "test@test.fr",
        "login"       => "mail@mxserver.com",
        "password"    => "password",
        "server"      => "smtp.mxserver.fr",
        "port"        => 465,
        "encryption"  => "ssl",
        "subject"     => "Notification subject",
        "message"     => "Notification Message",
        "htmlMessage" => "<h1>Titre</h1><p>message</p>",
        "attachments" => array()
    ))
    ->notify()
;
```
#### To send two email notifications :
Note : notification with and without notifier parameters
```php
$response = $this->get('notification_api_client.notifier')
    ->addNotification("email", array(
        "to"          => "to1@mail.com, to2@mail.com, to3@mail.com",
        "cc"          => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
        "bcc"         => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com",
        "transport"   => "smtp",
        "replyTo"     => "replyto@test.fr",
        "from"        => "test@test.fr",
        "login"       => "mail@mxserver.com",
        "password"    => "password",
        "server"      => "smtp.mxserver.fr",
        "port"        => 465,
        "encryption"  => "ssl",
        "subject"     => "Notification subject",
        "message"     => "Notification Message",
        "htmlMessage" => "<h1>Titre</h1><p>message</p>",
        "attachments" => array()
    ))
    ->addNotification("email", array(
        "notifierALias" => "my_email_alias",
        "to"            => "to1@mail.com, to2@mail.com, to3@mail.com",
        "cc"            => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
        "bcc"           => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com",
        "subject"       => "Notification subject",
        "message"       => "Notification Message",
        "htmlMessage"   => "<h1>Titre</h1><p>message</p>",
        "attachments"   => array()
    ))
    ->notify()
;
```
#### To send two email and one sms notifications :
```php
$response = $this->get('notification_api_client.notifier')
    ->addNotification("email", array(
        "to"          => "to1@mail.com, to2@mail.com, to3@mail.com",
        "cc"          => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
        "bcc"         => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com",
        "transport"   => "smtp",
        "replyTo"     => "replyto@test.fr",
        "from"        => "test@test.fr",
        "login"       => "mail@mxserver.com",
        "password"    => "password",
        "server"      => "smtp.mxserver.fr",
        "port"        => 465,
        "encryption"  => "ssl",
        "subject"     => "Notification subject",
        "message"     => "Notification Message",
        "htmlMessage" => "<h1>Titre</h1><p>message</p>",
        "attachments" => array()
    ))
    ->addNotification("email", array(
        "notifierALias" => "my_email_alias",
        "to"            => "to1@mail.com, to2@mail.com, to3@mail.com",
        "cc"            => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
        "bcc"           => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com",
        "subject"       => "Notification subject",
        "message"       => "Notification Message",
        "htmlMessage"   => "<h1>Titre</h1><p>message</p>",
        "attachments"   => array()
    ))
    ->addNotification("sms", array(
        "toPhoneNumber"   => "0612345678, 0610111213, 0610112214",
        "fromPhoneNumber" => "0625415878",
        "message"         => "Notification Message"
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
php app/console tms:notification:notify email '{"to":"to@mail.com","cc":"cc1@mail.com","bcc":"bcc1@mail.com","transport":"smtp","replyTo":"replyto@test.fr","from":"mail@mxserver.com","login":"mail@mxserver.com","password":"password","server":"smtp.mxserver.fr","port":465,"encryption":"ssl","subject":"Notification subject","message":"Notification Message","htmlMessage":"<h1>Titre<\/h1><p>message<\/p>","attachments":[]}'
```
Case 2 : notification without notifier parameters
```sh
php app/console tms:notification:notify email '{"notifierAlias": "alias", "to": "me@mymail.com", "cc": "cc1@mymail.com, cc2@mymail.com", "bcc": "bcc@mymail.com", "subject": "notification via command line", "message": "the message to be send", "htmlMessage": "<h1>Titre</h1><p>Message</p>", "attachments": []}'
```
