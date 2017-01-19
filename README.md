# Simple PHP wrapper for GreenArrow's sending email API

[![Build Status](https://travis-ci.org/bcismariu/greenarrow-php.svg?branch=master)](https://travis-ci.org/bcismariu/greenarrow-php)
[![Latest Stable Version](https://poser.pugx.org/bcismariu/greenarrow-php/v/stable)](https://packagist.org/packages/bcismariu/greenarrow-php)
[![License](https://poser.pugx.org/bcismariu/greenarrow-php/license)](https://packagist.org/packages/bcismariu/greenarrow-php)
[![Total Downloads](https://poser.pugx.org/bcismariu/greenarrow-php/downloads)](https://packagist.org/packages/bcismariu/greenarrow-php)

### Installation
Update your `composer.json` file
```json
{
    "require": {
        "bcismariu/greenarrow-php": "0.*"
    }
}
```
Run `composer update`

### Usage
```php

use Bcismariu\GreenArrow\GreenArrow;
use GuzzleHttp\Client;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

$mailer = new GreenArrow(new GuzzleAdapter(new Client()), [
    'username'      => 'username',
    'password'      => 'password',
]);

$mailer->send([
    'message'   => [
        'to' => [[
            'name'  => 'John Smith',
            'email' => 'john.smith@example.com'
        ]],
        'from_name'     => 'Jane Doe',
        'from_email'    => 'jane.doe@example.com',
        'subject'       => 'A simple subject',
        'html'          => '<h1>A simple html body</h1>',
    ],
]);

```

### Contributions

This is a very basic implementation that can only handle basic calls. Any project contributions are welcomed!
