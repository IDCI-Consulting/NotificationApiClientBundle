IDCINotificationApiClientBundle Configuration Reference
=======================================================

HTTP Client configuration
-------------------------

### Your application configuration :

#### Parameters
| Parameter      | Optionnal | Requirements | Description
|----------------|-----------|--------------|------------
| source_name    | true      | string value | The source name data

#### Configuration
Add configuration in `app/config/config.yml` file :
```yml
idci_notification_api_client:
    source_name: your_source_name
```

### Bundle configuration :
Previously you imported the bundle configuration in your `app/config/config.yml` file.
This section provides more informations about it.
Note : Please don't forget *to provide the value of "endpoint_root" and "security_token" parameters in your* `app/config/parameters.yml` file.

#### Parameters
| Parameters     | Optionnal | Requirements  | Description
|----------------|-----------|---------------|------------
| endpoint_root  | true      | string value  | Endpoint root data
| security_token | true      | string value  | Security token data
| cache_enabled  |           | true, false   | To enable or disable the cache

#### Bundle configuration in `Resources/config/config.yml` file :
```yml
da_api_client:
    api:
        notification:
            endpoint_root: %api.notification.endpoint_root%
            security_token: %api.security_token%
            cache_enabled: true
```
####