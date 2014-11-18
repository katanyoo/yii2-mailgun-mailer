Yii2 Mailgun Mailer
===================
Mailgun mailer for Yii 2 framework.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist katanyoo/yii2-mailgun-mailer "*"
```

or add

```
"katanyoo/yii2-mailgun-mailer": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \katanyoo\mailer\Mailer::widget(); ?>```