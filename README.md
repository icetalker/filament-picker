# A Regular Picker for Filament Form

[![Latest Version on Packagist](https://img.shields.io/packagist/v/icetalker/filament-picker.svg?style=flat-square)](https://packagist.org/packages/icetalker/filament-picker)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/icetalker/filament-picker/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/icetalker/filament-picker/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/icetalker/filament-picker/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/icetalker/filament-picker/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/icetalker/filament-picker.svg?style=flat-square)](https://packagist.org/packages/icetalker/filament-picker)

A Regular Picker for Filament Form.

![image](https://raw.githubusercontent.com/icetalker/filament-picker/main/screenshots/picker-dark.png)

![image](https://raw.githubusercontent.com/icetalker/filament-picker/main/screenshots/picker-light.png)

## Installation

You can install the package via composer:

```bash
composer require icetalker/filament-picker
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-picker-view"
```

## Usage

```php

public function form(Form $form): Form
{
    return $form
        ->schema([

            Picker::make('transport')
                ->label('Transport')
                ->options([
                    'ship' => 'By Sea',
                    'airplane' => 'By Air',
                    'truck' => 'By Truck',
                ])
                ->icons([
                    'ship' => 'heroicon-o-home',
                    'airplane' => 'heroicon-o-paper-airplane',
                    'truck' => 'heroicon-o-truck',
                ])
                ->columns(3) // Optional. Use it as the official Filament columns() method.
                ->imageSize(['100%', '']) // Optional. You can enter the width and height respectively in px or %.
                ->imageObjectFit('cover') // Optional.
                ->imageAspectRatio(['2/1']) // Optional. Usefull if you do not want to set both width and height. To make it responsive.
                ->images([
                    'ship' => 'https://source.unsplash.com/random/100x100/?ship',
                    'airplane' => 'https://source.unsplash.com/random/100x100/?airplane',
                    'truck' => 'https://source.unsplash.com/random/100x100?truck',
                ])
                ->default('ship'),
        ]);
}
```

### Define Options

To define options, you can use the `options()` method and pass an array of key-value pairs. The key will be the value of the option, and the value will be the label to be displayed.

```php
Picker::make('transport')
    ->options([
        'ship' => 'By Sea',
        'airplane' => 'By Air',
        'truck' => 'By Truck',
    ]);
```

### Add Icons

To add icons, you can use the `icons()` method and pass an array of key-value pairs. The key will be the value of the option, and the value will be the icon to be displayed:

```php
Picker::make('transport')
    ->label('Transport')
    ->options([
        'ship' => 'By Sea',
        'airplane' => 'By Air',
        'truck' => 'By Truck',
    ])
    ->icons([
        'ship' => 'heroicon-o-home',
        'airplane' => 'heroicon-o-paper-airplane',
        'truck' => 'heroicon-o-truck',
    ])
```

### Add Images

To add images, you can use the `images()` method and pass an array of key-value pairs. The key will be the value of the option, and the value will be the image url to be displayed:

```php
Picker::make('transport')
    ->label('Transport')
    ->options([
        'ship' => 'By Sea',
        'airplane' => 'By Air',
        'truck' => 'By Truck',
    ])
    ->images([
        'ship' => 'https://source.unsplash.com/random/100x100/?ship',
        'airplane' => 'https://source.unsplash.com/random/100x100/?airplane',
        'truck' => 'https://source.unsplash.com/random/100x100?truck',
    ]);
```

The size of images is 50x50 by default, you can custom the size of images by using the `imageSize()` method and pass the size in pixels.

### Default Value

To set a default value, you can use the `default()` method and pass the value of the option:

```php
Picker::make('transport')
    ->label('Transport')
    ->options([
        'ship' => 'By Sea',
        'airplane' => 'By Air',
        'truck' => 'By Truck',
    ])
    ->default('ship');
```

## Todo

- Add Relationship Support
- Add Validation

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Martin H](https://github.com/icetalker)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
