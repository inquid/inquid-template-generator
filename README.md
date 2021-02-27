Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiiforces/inquid-template-generator "*"
```

or add

```
"yiiforces/inquid-template-generator": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :
add repository in your composer.json
```json
    "repositories": [
        {   "type": "vcs",
            "url": "https://github.com/yiiforces/inquid-template-generator"
        }
    ]
```
in config/web.php and config/console.php add this:
```php
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'inquid-template' => [
                'class' => 'yiiforces\inquidTemplateGenerator\Generator'
            ],
        ],
    ];
}


```

