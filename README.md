Yii Mocean
===============
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
        'class' => 'yiimocean\MoceanServiceProvider',
        'defaults' => 'main',
        'accounts' => [ //define your account here
            'main' => [
                'apiKey' => 'mainAccountApiKey',
                'apiSecret' => 'mainAccountApiSecret',
                'from' => 'David'
            ],
            'secondary' => [ //if you have more then one account
                'apiKey' => 'secondaryAccountApiKey',
                'apiSecret' => 'secondaryAccountApiSecret',
                'from' => 'John'
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
Yii::$app->mocean->message('60123456789','Simple Text');
```

If you have multiple account defined in config

```php
Yii::$app->mocean->using('secondary')->message('60123456789', 'Simple Text');
Yii::$app->mocean->using('third')->message('60123456789', 'Simple Text');
```

Get the configured [Mocean SDK](https://github.com/MoceanAPI/mocean-sdk-php) Object
```php
$sdk = Yii:$app->mocean->getMocean();
$accBalance = $sdk->account()->getBalance(['mocean-resp-format' => 'JSON']);
```

## License

Laravel Mocean is licensed under the [MIT License](LICENSE)
