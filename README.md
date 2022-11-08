# Nue Boilerplate

[![Packagist](https://img.shields.io/packagist/l/novay/nue.svg?maxAge=2592000)](https://packagist.org/packages/novay/nue)
[![Total Downloads](https://img.shields.io/packagist/dt/novay/nue.svg?style=flat-square)](https://packagist.org/packages/novay/nue)
[![Pull request welcome](https://img.shields.io/badge/pr-welcome-green.svg?style=flat-square)]()


You'll find the documentation on [https://nue.btekno.id/docs](https://nue.btekno.id/docs).

## Screenshot

![nue-package.png](https://raw.githubusercontent.com/novay/imagehost/master/nue-package.png)

## Documentation

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Components](#components)
    - [Alert](#alert)
- [License](#license)

## Requirements
- PHP 7+
- Laravel 5, 6, 7, 8, 9

Important to note :
You can try this within a new project, because i'm worried that it will interfere or even damage the database structure & resource views of the project you've created before. For more details, [please see here](https://nue.btekno.id/docs/nue/getting-started/installation).

## Installation 

1. Install package via composer : 

```bash
composer require novay/nue "3.104"
```

2. Configure your DB :

It's important! Because this package will run a migration command automatically behind the scene.

3. Execute this installation:


```bash
php artisan nue:install --force
```

4. And you are ready to go!

## Configuration

For the first, you can use this default credential :
- Username : `novay@btekno.id`
- Password : `adminsss`

Make sure to check out our config files at `config/nue.php`. Here you can :
- Change the default application name
- Customize brands or assets files like favicon and the application logo.
- Disable some built in features like `registration`, `account deletion` etcetera.
- And others configurations which you can play with.

## Components (Coming Soon! Unstable)

### Alert

A Nue alert:

```html
<x-nue::alert
    :label="__('It was successful!')"
    color="info"
    dismissible
/>
```

#### Available Props & Slots

- `icon`: Iconify icon to show before label e.g. `icon-park-twotone:add-one`, `heroicons-solid:badge-check`
- `label`: label to display, can also be placed in the `slot`
- `color`: Available color e.g. `primary`, `danger`, `success`, `warning`, `soft-*`
- `dismissible`: set the alert to be dismissible

---

...

License
------------
Licensed under [The MIT License (MIT)](LICENSE).
