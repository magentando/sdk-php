# Intelipost PHP Client Library

Intelipost is a simple, fast and secure shipping and logistics gateway API. You can sign up for an account at http://www.intelipost.com.br

Installation
------------
There are two ways to install:

 **Require Library**

```php
require_once("/path/to/lib/intelipost.php");
```

**or via [Composer](http://getcomposer.org/):**

Create or add the following to composer.json in your project root:
```javascript
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/intelipost/api-php"
        }
    ],
    "require": {
        "intelipost/api-php": "dev-master"
    }
}
```

Install composer dependancies:
```shell
php composer.phar install
```

Require dependencies:
```php
require_once("/path/to/vendor/autoload.php");
```

Documentation
--------------------
Up-to-date documentation at: http://docs.intelipost.com.br


Releases
--------------------
## 0.2.3
*2014-03-24 | Pablo del Vecchio*

- changed base folder


## 0.2.2
*2014-03-18 | Pablo del Vecchio*

- updated composer.json


## 0.2.1
*2014-03-18 | Pablo del Vecchio*

- added timeout fallback


## 0.1.0
*2014-03-11 | Pablo del Vecchio*

- initial commit
