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
# Usage

```php
require __DIR__ ."/vendor/autoload.php";

// The class the will automatically creates the env.example during instantiation
$env = new \EnvHandler\Environment\Environment(__DIR__);
```
```php
// true parameter will automatically creates the .env at the root path of application with the value from .env.example
$env->load(true);
```
```php
To manually create an env file,
$env->load();
```
```php
var_dump($env->getEnvFileContent());
```
# sample output
Call the value from .env file anywhere in your project.
```php
echo getEnv('APP_URL'); // Output: http://localhost
echo getEnv('APP_NAME'); // Output: App Name
echo getEnv('APP_ENV'); // Output: development

echo getEnv('YOUR_CUSTOM_KEY_HERE_FROM_ENV')
```
