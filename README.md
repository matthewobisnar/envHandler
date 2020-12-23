# Installation
To install with composer:
```
composer require envhandler/envhandler
```
# Env Sample Format
```.env
APP_NAME=null
APP_URL=http://localhost
APP_ENV=development

DB_CONNECTIONS=pdo
DB_USERNAME=dumpy_username
DB_PASSWORD=dumpy_password
DB_NAME=dump_dbname
DB_HOST=localhost
DB_PORT=8080

MAILER=PHPMailer
MAIL_MAILER=null
MAIL_HOST=null
MAIL_PORT=null
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME=null
```
# Basic Example

```php
require __DIR__ ."/vendor/autoload.php";

$env = new \EnvHandler\Environment\Environment(__DIR__);

$env->load(true);

```
