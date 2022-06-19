# Nue Boilerplate

[![Packagist](https://img.shields.io/packagist/l/novay/nue.svg?maxAge=2592000)](https://packagist.org/packages/novay/nue)
[![Total Downloads](https://img.shields.io/packagist/dt/novay/nue.svg?style=flat-square)](https://packagist.org/packages/novay/nue)
[![Pull request welcome](https://img.shields.io/badge/pr-welcome-green.svg?style=flat-square)]()

Complete Boilerplate for Laravel. This package also contains a set of useful Laravel Blade components. It promotes DRY principles and allows you to keep your HTML nice and clean. Components include alerts, badges, buttons, form inputs (with automatic error feedback), pagination (responsive), and more. The components come with Laravel Livewire integration built in, so you can use them with or without Livewire.

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

- Laravel
- Livewire (Optional)
- Iconify must be called to use icons, simply use CDN

**You should to know**

Nue should only be installed into new Laravel applications. Attempting to install Nue into an existing Laravel application will result in unexpected behavior and issues. There are some files that you need to pay attention to:
1. `database\migrations\2014_10_12_000000_create_users_table.php` replaced.
2. `App\Http\Controllers\*` and `App\Http\HomeController.php` created or replaced if exists.
3. `App\Models\User.php` replaced.
4. `routes\web.php` modified.
5. `resources\views\welcome.blade.php`, `resources\views\dashboard.blade.php`, `resources\views\auth\*`, `resources\views\layouts\*` and `resources\views\profile\*` created or replaced if exists.

## Installation

Require the package via composer:


```bash
composer require novay/nue -vvv
```

Install with:

```bash
php artisan nue:install --force
```

And you are ready to go!

## Configuration

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