Yii Mocean
===============
[![Latest Stable Version](https://img.shields.io/packagist/v/mocean/yii-mocean.svg)](https://packagist.org/packages/mocean/yii-mocean)
[![Build Status](https://img.shields.io/travis/com/MoceanAPI/yii-mocean.svg)](https://travis-ci.com/MoceanAPI/yii-mocean)
[![StyleCI](https://github.styleci.io/repos/161600641/shield?branch=master)](https://github.styleci.io/repos/161600641)
[![License](https://img.shields.io/packagist/l/mocean/yii-mocean.svg)](https://packagist.org/packages/mocean/yii-mocean)
[![Total Downloads](https://img.shields.io/packagist/dt/mocean/yii-mocean.svg)](https://packagist.org/packages/mocean/yii-mocean)

Yii Mocean API Integration

## Installation

To install the library, run this command in terminal:
```bash
composer require mocean/yii-mocean
```

Set configuration in config file
```php
'components' => [
    'mocean' => [
        'class' => 'YiiMocean\MoceanServiceProvider',
        'defaults' => 'main',
        'accounts' => [ //define your account here
            'main' => [
                'api_key' => 'mainAccountApiKey',
                'api_secret' => 'mainAccountApiSecret'
            ],
            'secondary' => [ //if you have more then one account
                'api_key' => 'secondaryAccountApiKey',
                'api_secret' => 'secondaryAccountApiSecret'
            ]
        ],
    ],
]
```

## Usage

Send a text message

```php
//will be using the account defined in defaults
//see below if you have multiple accounts
Yii::$app->mocean->message()->send([
    'mocean-to' => '60123456789',
    'mocean-from' => 'MOCEAN',
    'mocean-text' => 'Hello World'
])
```

If you have multiple account defined in config

```php
Yii::$app->mocean->using('secondary')->message()->send(...);
Yii::$app->mocean->using('third')->message()->send(...);
```

## License

Laravel Mocean is licensed under the [MIT License](LICENSE)
