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
| fromName    | true     | string value         | The name associated to an email address
| replyTo     | true     | string value         | Email address to reply
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
| true            | This function return only the value true if the notification has been sent. If not, an Da\ApiClientBundle\Exception\ApiHttpResponseException will be thrown.

#### Case 1 : notification with notifier parameters
```php
$response1 = $this->get('notification_api_client.notifier')
    ->addNotification("email", array(
        "to"          => "to1@mail.com, to2@mail.com, to3@mail.com",
        "cc"          => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
        "bcc"         => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com",
        "transport"   => "smtp",
        "from"        => "test@test.fr",
        "fromName"    => "Test",
        "replyTo"     => "replyto@test.fr",
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
| true            | This function return only the value true if the notification has been sent. If not, an Da\ApiClientBundle\Exception\ApiHttpResponseException will be thrown.

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
### Sms Ocito

#### Field "notifierAlias" :

| Optional | Requirements | Description
|----------|--------------|------------
| true     | string value | The notifier alias used to define a configuration

#### Field "to" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| phoneNumber | false    | string value | Recipient phone number must be in international format (exemple : 33612345698 for a french phone number)

#### Field "from" :

| Subfield          | Optional | Requirements  | Description
|-------------------|----------|---------------|------------
| userName          | true     | string value  | SMS Manager's account name
| password          | true     | string value  | SMS Manager's password
| senderAppId       | true     | string value  | Id of the application used to send SMS
| senderId          | true     | string value  | Id of the sender
| flag              | true     | integer value | Flag value
| priority          | true     | string value  | H : high, L : low
| timeToLiveTimeout | true     | integer value | Timeout used to define "time to live" of a SMS
| timeToSendTimeout | true     | integer value | Timeout used to define the moment when the SMS should be sent (deferred message).

Note : How to define the flag

| Flag    | Requirements | Possible values | Description
|---------|--------------|-----------------|------------
| F0      |              | 0 or 1          | SMS Manger Push asks acquittals and acknowledgments from carrier
| F1      | F0 enabled   | 0 or 2          | Ask SMS Manager Push to send acquittals and acknowledgments to client applcation
| F2      |              | 0 or 4          | Enable special class (F2=0 enable class 1)
| F3 + F4 | F2 enabled   | 0, 8, 16 or 24  | [00] class 0 : flash; [01] class 1 : default value from cellphone; [10] class 2 : saved on SIM card ; [11] class 3: saved in cellphone

Exemple :

1. Client application doesn't want to recieve acquittals and acknowledgments : flag = 0
2. SMS with acquittals and acknowledgments : flag = 1*2⁰ + 1*2¹ = 3
3. Class 2 SMS with acquittals and acknowledgments : flag = 1*2⁰ + 1*2¹ + 1*2² + 1*2⁴ = 23

#### Field "content" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| message     | true     | string value | Message data (only 70 characters)

#### Results
The function `notify()` returns a response from an API Client.

| Response values | Meaning
|-----------------|--------
| true            | This function return only the value true if the notification has been sent. If not, an Da\ApiClientBundle\Exception\ApiHttpResponseException will be thrown.

#### Case 1 : notification with notifier parameters
```php
$response1 = $this->get('notification_api_client.notifier')
    ->addNotification("smsOcito", array(
        'userName'          => "userName_value",
        'password'          => "password_value",
        'senderAppId'       => "1234",
        'senderId'          => "senderId_value",
        'flag'              => 3,
        'priority'          => "H",
        "phoneNumber"       => "33612345678",
        "message"           => "Notification Message",
        'timeToLiveTimeout' => 10,
        'timeToLiveTimeout' => 20
    ))
    ->notify()
;
```

#### Case 2 : notification without notifier parameters
```php
$response2 = $this->get('notification_api_client.notifier')
    ->addNotification("sms", array(
        "notifierALias" => "my_sms_ocito_alias",
        "phoneNumber"   => "33612345678",
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
| true            | This function return only the value true if the notification has been sent. If not, an Da\ApiClientBundle\Exception\ApiHttpResponseException will be thrown.

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
| true            | This function return only the value true if the notification has been sent. If not, an Da\ApiClientBundle\Exception\ApiHttpResponseException will be thrown.

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

#### Field "from" :

| Subfield               | Optional | Requirements | Description
|------------------------|----------|--------------|------------
| consumerKey            | true     | string value | Consumer key data
| consumerSecret         | true     | string value | Consumer secret data
| oauthAccessToken       | true     | string value | Oauth access token data
| oauthAccessTokenSecret | true     | string value | Oauth access token secret data

#### Field "content" :

| Subfield | Optional | Requirements | Description
|----------|----------|--------------|------------
| status   | false    | string value | Twitter status data

#### Results
The function `notify()` returns a response from an API Client.

| Response values | Meaning
|-----------------|--------
| true            | This function return only the value true if the notification has been sent. If not, an Da\ApiClientBundle\Exception\ApiHttpResponseException will be thrown.

#### Case 1 : notification with notifier parameters
```php
$response1 = $this->get('notification_api_client.notifier')
    ->addNotification("twitter", array(
        'consumerKey'            => "your_consumer_key",
        'consumerSecret'         => "your_consumer_secret",
        'oauthAccessToken'       => "your_oauth_access_token",
        'oauthAccessTokenSecret' => "your_oauth_access_token_secret",
        "status"                 => "your twitter status"
    ))
    ->notify()
;
```
#### Case 2 : notification without notifier parameters
```php
$response2 = $this->get('notification_api_client.notifier')
    ->addNotification("twitter", array(
        "notifierAlias" => "Your_notifierAlias",
        "status"        => "your twitter status"
    ))
    ->notify()
;
```

### PushIOS

#### Field "notifierAlias" :

| Optional | Requirements | Description
|----------|--------------|------------
| true     | string value | The notifier alias used to define a configuration

#### Field "to" :

| Subfield      | Optional | Requirements | Description
|---------------|----------|--------------|------------
| deviceToken   | false    | string value | An "address" that a push notification will be sent to.

#### Field "content" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| message     | false    | string value | Message data

#### Results
The function `notify()` returns a response from an API Client.

| Response values | Meaning
|-----------------|--------
| true            | This function return only the value true if the notification has been sent. If not, an Da\ApiClientBundle\Exception\ApiHttpResponseException will be thrown.

#### Notification with an notifier alias
```php
$response2 = $this->get('notification_api_client.notifier')
    ->addNotification("pushIOS", array(
        "notifierAlias" => "my_push_ios_alias",
        "deviceToken"   => "c5de75d953cff905600hdju153er91f688d146d408ada5a8d4531d546e20ce6",
        "message"       => "push iOS message"
    ))
    ->notify()
;
```
Note : You can only use a notification with an notifier alias.

### Push Android

#### Field "notifierAlias" :

| Optional | Requirements | Description
|----------|--------------|------------
| true     | string value | The notifier alias used to define a configuration

#### Field "to" :

| Subfield      | Optional | Requirements | Description
|---------------|----------|--------------|------------
| deviceToken   | false    | string value | The token used to identify an android device.

#### Field "from" :

| Subfield | Optional | Requirements | Description
|----------|----------|--------------|------------
| apiKey   | true     | string value | The key using to identify an android application

#### Field "content" :

| Subfield    | Optional | Requirements | Description
|-------------|----------|--------------|------------
| message     | false    | string value | Message data

#### Results
The function `notify()` returns a response from an API Client.

| Response values | Meaning
|-----------------|--------
| true            | This function return only the value true if the notification has been sent. If not, an Da\ApiClientBundle\Exception\ApiHttpResponseException will be thrown.

#### Case 1 : notification with notifier parameters
```php
$response1 = $this->get('notification_api_client.notifier')
    ->addNotification("pushAndroid", array(
        "deviceToken" => "your_device_token",
        "apiKey"      => "your_api_key",
        "message"     => "Push android message"
    ))
    ->notify()
;
```

#### Case 2 : notification without notifier parameters
```php
$response2 = $this->get('notification_api_client.notifier')
    ->addNotification("pushAndroid", array(
        "notifierAlias" => "your_push_android_alias",
        "deviceToken"   => "your_device_token",
        "message"       => "Push android message"
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
        "from"        => "test@test.fr",
        "fromName"    => "Test",
        "replyTo"     => "replyto@test.fr",
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
        "from"        => "test@test.fr",
        "fromName"    => "Test",
        "replyTo"     => "replyto@test.fr",
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
        "from"        => "test@test.fr",
        "fromName"    => "Test",
        "replyTo"     => "replyto@test.fr",
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
php app/console tms:notification:notify email '{"to":"to@mail.com","cc":"cc1@mail.com","bcc":"bcc1@mail.com","transport":"smtp","from":"mail@mxserver.com","fromName":"Test","replyTo":"replyto@test.fr","login":"mail@mxserver.com","password":"password","server":"smtp.mxserver.fr","port":465,"encryption":"ssl","subject":"Notification subject","message":"Notification Message","htmlMessage":"<h1>Titre<\/h1><p>message<\/p>","attachments":[]}'
```
Case 2 : notification without notifier parameters
```sh
php app/console tms:notification:notify email '{"notifierAlias": "alias", "to": "me@mymail.com", "cc": "cc1@mymail.com, cc2@mymail.com", "bcc": "bcc@mymail.com", "subject": "notification via command line", "message": "the message to be send", "htmlMessage": "<h1>Titre</h1><p>Message</p>", "attachments": []}'
```
Advice
------

You should send a notification in a try/catch block.
Example : how to send a notification with notifier parameters in a try/catch block

```php
try {
    $response1 = $this->get('notification_api_client.notifier')
        ->addNotification("email", array(
            "to"          => "to1@mail.com, to2@mail.com, to3@mail.com",
            "cc"          => "cc1@mail.com, cc2@mail.com, cc3@mail.com",
            "bcc"         => "bcc1@mail.com, bcc2@mail.com, bcc3@mail.com",
            "transport"   => "smtp",
            "from"        => "test@test.fr",
            "fromName"    => "Test",
            "replyTo"     => "replyto@test.fr",
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
} catch (\Da\ApiClientBundle\Exception\ApiHttpResponseException $e) {
    echo $e->getMessage();
}
```