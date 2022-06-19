# Nue Boilerplate

[![Packagist](https://img.shields.io/packagist/l/novay/nue.svg?maxAge=2592000)](https://packagist.org/packages/novay/nue)
[![Total Downloads](https://img.shields.io/packagist/dt/novay/nue.svg?style=flat-square)](https://packagist.org/packages/novay/nue)
[![Pull request welcome](https://img.shields.io/badge/pr-welcome-green.svg?style=flat-square)]()

Complete Boilerplate for Laravel. This package also contains a set of useful Laravel Blade components. It promotes DRY principles and allows you to keep your HTML nice and clean. Components include alerts, badges, buttons, form inputs (with automatic error feedback), pagination (responsive), and more. The components come with Laravel Livewire integration built in, so you can use them with or without Livewire.

## Documentation

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Components (Coming Soon! Unstable)](#components)
    - [Alert](#alert)
    - ...
- [Publishing Assets](#publishing-assets)
    - [Custom Views](#custom-views)
    - [Custom Icons](#custom-icons)

## Requirements

- Laravel
- Livewire (Optional)
- Iconify must be called to use icons, simply use CDN

## Installation

**New Applications Only**

Nue should only be installed into new Laravel applications. Attempting to install Nue into an existing Laravel application will result in unexpected behavior and issues. There are some files that you need to pay attention to:
1. `database\migrations\2014_10_12_000000_create_users_table.php` replaced.
2. `App\Http\Controllers\*` and `App\Http\HomeController.php` created or replaced if exists.
3. `App\Models\User.php` replaced.
4. `routes\web.php` modified.
5. `resources\views\welcome.blade.php`, `resources\views\dashboard.blade.php`, `resources\views\auth\*`, `resources\views\layouts\*` and `resources\views\profile\*` created or replaced if exists.

Require the package via composer:


```bash
$ composer require novay/nue -vvv
```

Install with:

```bash
$ php artisan nue:install --force
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

### Badge

A Nue badge:

```html
<x-nue::badge
    :label="__('Pending')"
    color="warning"
/>
```

#### Available Props & Slots

- `icon`: Iconify icon to show before label e.g. `icon-park-twotone:add-one`, `heroicons-solid:badge-check`
- `label`: label to display, can also be placed in the `slot`
- `color`: Nue color e.g. `primary`, `danger`, `success`, `warning`, `soft-*`

---

### Button

A Nue button:

```html
<x-nue::button
    :label="__('Login')"
    color="primary"
    size="lg"
    route="login"
/>
```

#### Available Props & Slots

- `icon`: Iconify icon to show before label e.g. `cog`, `envelope`
- `label`: label to display, can also be placed in the `slot`
- `color`: Nue color e.g. `primary`, `danger`, `success`
- `size`: Nue button size e.g. `sm`, `lg`
- `type`: button type e.g. `button`, `submit`
- `route`: sets the `href` to a route
- `url`: sets the `href` to a url
- `href`: sets the `href`
- `dismiss`: a `data-bs-dismiss` value e.g. `alert`, `modal`
- `toggle`: a `data-bs-toggle` value e.g. `collapse`, `dropdown`
- `click`: Livewire action on click
- `confirm`: prompts the user for confirmation on click

---

### Check

A Nue checkbox input:

```html
<x-nue::form.check
    :label="__('Agree')"
    :checkLabel="__('I agree to the TOS')"
    :help="__('Please accept the TOS.')"
    switch
    model="agree"
/>
```

#### Available Props & Slots

- `label`: label to display above the input
- `checkLabel`: label to display beside the input
- `help`: helper label to display under the input
- `switch`: style the input as a switch
- `model`: Livewire model property key
- `lazy`: bind Livewire data on change

---

### Close

A Nue close button:

```html
<x-nue::close 
    dismiss="modal"
/>
```

#### Available Props & Slots

- `color`: Nue close color e.g. `white`
- `dismiss`: a `data-bs-dismiss` value e.g. `alert`, `modal`

---

### Color

A Nue color picker input:

```html
<x-nue::color
    :label="__('Favorite Color')"
    :prepend="__('I like')"
    :append="_('the most.')"
    :help="__('Please pick a color.')"
    model="favorite_color"
/>
```

#### Available Props & Slots

- `label`: label to display above the input
- `icon`: Iconify icon to show before input e.g. `cog`, `envelope`
- `prepend`: addon to display before input, can be used via named slot
- `append`: addon to display after input, can be used via named slot
- `size`: Nue input size e.g. `sm`, `lg`
- `help`: helper label to display under the input
- `model`: Livewire model property key
- `lazy`: bind Livewire data on change

---

### Desc

A description list:

```html
<x-nue::desc 
    :term="__('ID')"
    :details="$user->id"
/>
```

#### Available Props & Slots

- `tern`: the description list term
- `details`: the description list details, can also be placed in the `slot`
- `date`: date to use instead of details (for use with [Laravel Timezone](https://github.com/jamesmills/laravel-timezone))

---

### Form

A Nue form:

```html
<x-nue::form submit="login">
    <x-nue::form.input :label="__('Email')" type="email" model="email"/>
    <x-nue::form.input :label="__('Password')" type="password" model="password"/>
    <x-nue::button :label="__('Login')" type="submit"/>
</x-nue::form>
```

#### Available Props & Slots

- `submit`: Livewire action on submit

### Icon

A Iconify icon:

```html
<x-nue::icon
    name="cog"
/>
```

#### Available Props & Slots

- `name`: Iconify icon name e.g. `cog`, `rocket`
- `style`: Iconify icon style e.g. `solid`, `regular`, `brands`
- `size`: Iconify icon size e.g. `sm`, `lg`, `3x`, `5x`
- `color`: Nue color e.g. `primary`, `danger`, `success`
- `spin`: sets the icon to use a spin animation
- `pulse`: sets the icon to use a pulse animation

---

### Image

An image:

```html
<x-nue::image
    asset="images/logo.png"
    height="24"
    rounded
/>
```

#### Available Props & Slots

- `asset`: sets the `src` to an asset
- `src`: sets the `src`
- `fluid`: sets the image to be fluid width
- `thumbnail`: sets the image to use thumbnail styling
- `rounded`: sets the image to have rounded corners

---

### Input

A Nue text input:

```html
<x-nue::form.input
    :label="__('Email Address')"
    type="email"
    :help="__('Please enter your email.')"
    model="email_address"
>
    <x-slot name="prepend">
        <i class="fa fa-envelope"></i>
    </x-slot>
</x-nue::form.input>
```

#### Available Props & Slots

- `label`: label to display above the input
- `type`: input type e.g. `text`, `email`
- `icon`: Iconify icon to show before input e.g. `cog`, `envelope`
- `prepend`: addon to display before input, can be used via named slot
- `append`: addon to display after input, can be used via named slot
- `size`: Nue input size e.g. `sm`, `lg`
- `help`: helper label to display under the input
- `model`: Livewire model property key
- `debounce`: time in ms to bind Livewire data on keyup e.g. `500`
- `lazy`: bind Livewire data on change

---

### Link

A hyperlink:

```html
<x-nue::link
    :label="__('Users')"
    route="users"
/>
```

#### Available Props & Slots

- `icon`: Iconify icon to show before label e.g. `cog`, `envelope`
- `label`: label to display, can also be placed in the `slot`
- `route`: sets the `href` to a route
- `url`: sets the `href` to a url
- `href`: sets the `href`

---

### Pagination

Responsive Nue pagination links:

```html
<x-nue::pagination
    :links="App\Models\User::paginate()"
    justify="center"
/>
```

#### Available Props & Slots

- `links`: paginated Laravel models
- `justify`: Nue justification e.g. `start`, `end`

---

### Progress

A Nue progress bar:

```html
<x-nue::progress
    :label="__('25% Complete')"
    percent="25"
    color="success"
    height="10"
    animated
    striped
/>
```

#### Available Props & Slots

- `label`: label to display inside the progress bar
- `percent`: percentage of the progress bar
- `color`: Nue color e.g. `primary`, `danger`, `success`
- `height`: height of the progress bar in pixels
- `animated`: animate the progress bar
- `striped`: use striped styling for the progress bar

---

### Radio

A Nue radio input:

```html
<x-nue::form.radio
    :label="__('Gender')"
    :options="['Male', 'Female']"
    :help="__('Please select your gender.')"
    switch
    model="gender"
/>
```

#### Available Props & Slots

- `label`: label to display above the input
- `options`: array of input options e.g. `['Red', 'Blue']`
- `help`: helper label to display under the input
- `switch`: sets the input to use a switch style
- `model`: Livewire model property key
- `lazy`: bind Livewire data on change

---

### Select

A Nue select input:

```html
<x-nue::form.select
    :label="__('Your Country')"
    :placeholder="__('Select Country')"
    :options="['Australia', 'Canada', 'USA']"
    :prepend="__('I live in')"
    :append="_('right now.')"
    :help="__('Please select your country.')"
    model="your_country"
/>
```

#### Available Props & Slots

- `label`: label to display above the input
- `placeholder`: placeholder to use for the empty first option
- `options`: array of input options e.g. `['Red', 'Blue']`
- `icon`: Iconify icon to show before input e.g. `cog`, `envelope`
- `prepend`: addon to display before input, can be used via named slot
- `append`: addon to display after input, can be used via named slot
- `size`: Nue input size e.g. `sm`, `lg`
- `help`: helper label to display under the input
- `model`: Livewire model property key
- `lazy`: bind Livewire data on change

---

### Textarea

A Nue textarea input:

```html
<x-nue::form.textarea
    :label="__('Biography')"
    rows="5"
    :help="__('Please tell us about yourself.')"
    model="biography"
/>
```

#### Available Props & Slots

- `label`: label to display above the input
- `icon`: Iconify icon to show before input e.g. `cog`, `envelope`
- `prepend`: addon to display before input, can be used via named slot
- `append`: addon to display after input, can be used via named slot
- `size`: Nue input size e.g. `sm`, `lg`
- `help`: helper label to display under the input
- `model`: Livewire model property key
- `debounce`: time in ms to bind Livewire data on keyup e.g. `500`
- `lazy`: bind Livewire data on change


## Publishing Assets

### Custom Views

Use your own component views by publishing the package views:

```
php artisan vendor:publish --tag=nue-components:views
```

Now edit the files inside `resources/views/vendor/nue`. The package will use these files to render the components.

### Custom Icons

Use your own font icons by publishing the package config:

```
php artisan vendor:publish --tag=nue-components:config
```

Now edit the `icon_class_prefix` value inside `config/nue/components.php`. The package will use this class to render the icons.

License
------------
Licensed under [The MIT License (MIT)](LICENSE).