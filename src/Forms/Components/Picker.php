<?php

namespace Icetalker\FilamentPicker\Forms\Components;

use Closure;
use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Forms\Components\Field;
use Filament\Support\Concerns\HasExtraAlpineAttributes;

class Picker extends Field
{
    use HasOptions;
    use HasExtraAlpineAttributes;

    protected string $view = 'filament-picker::picker';

    protected array | Closure $icons = [];

    protected array | Closure $images = [];

    protected int | Closure | null $imageSize = null;

    protected bool | Closure $imageOnly = false;

    protected function setUp(): void
    {
        parent::setUp();

    }

    public function icons(array | Closure $icons): static
    {
        $this->icons = $icons;

        return $this;
    }

    public function getIcons(): array
    {
        return (array)$this->evaluate($this->icons);
    }

    public function images(array | Closure $images)
    {
        $this->images = $images;

        return $this;
    }

    public function getImages(): array
    {
        return (array)$this->evaluate($this->images);
    }

    public function imageSize(int | Closure $size): static
    {
        $this->imageSize = $size;

        return $this;
    }

    public function getImageSize(): array
    {
        $size = $this->evaluate($this->imageSize);

        if (is_int($size)) {
            return ["{$size}px", null];
        }

        if (is_string($size)) {
            return [$size, null];
        }

        if (is_array($size)) {
            $width = $size[0] ?? null;
            $height = $size[1] ?? null;

            $width = is_int($width) ? "{$width}px" : (string) $width;
            $height = is_int($height) ? "{$height}px" : (string) $height;

            return [$width, $height];
        }

        return ['auto', null];
    }

    public function imageOnly(bool | Closure $condition = true){
        $this->imageOnly = $condition;
        return $this;
    }

    public function getImageOnly(){
        return $this->evaluate($this->imageOnly);
    }

}
