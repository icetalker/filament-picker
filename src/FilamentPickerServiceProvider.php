<?php

namespace Icetalker\FilamentPicker;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentPickerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-picker')
            ->hasViews();
    }

    public function boot()
    {
        $this->bootLoaders();
        $this->bootPublishing();
    }

    protected function bootLoaders()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-picker');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'filament-picker');
    }

    protected function bootPublishing()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/filament-picker'),
        ], 'filament-picker-view');
    }
}
