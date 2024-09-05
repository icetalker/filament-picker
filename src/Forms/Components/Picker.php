<?php

namespace Icetalker\FilamentPicker\Forms\Components;

use Closure;
use Filament\Forms\Components\Field;
use Filament\Forms\Concerns\HasColumns;
use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Support\Concerns\HasExtraAlpineAttributes;

class Picker extends Field
{
    use HasOptions;
    use HasColumns;
    use HasExtraAlpineAttributes;

    protected string $view = 'filament-picker::picker';

    protected array | Closure $icons = [];

    protected array | Closure $images = [];

    protected array | Closure $imageSize = [];

    protected bool | Closure $imageOnly = false;

    protected String | Closure $imageObjectFit = 'cover';

    protected String | Closure $imageAspectRatio = '1/1';

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

    public function imageSize(array | Closure $size): static
    {
        $this->imageSize = $size;

        return $this;
    }

    public function getImageSize(): array
    {
        return (array)$this->evaluate($this->imageSize);
    }

    public function imageOnly(bool | Closure $condition = true){
        $this->imageOnly = $condition;
        return $this;
    }

    public function getImageOnly(){
        return $this->evaluate($this->imageOnly);
    }

    public function imageObjectFit(String | Closure $imageObjectFit = 'cover'){
        $this->imageObjectFit = $imageObjectFit;
        return $this;
    }

    public function getImageObjectFit(){
        return $this->evaluate($this->imageObjectFit);
    }

    public function imageAspectRatio(String | Closure $imageAspectRatio = '1/1'){
        $this->imageAspectRatio = $imageAspectRatio;
        return $this;
    }

    public function getImageAspecRatio(){
        return $this->evaluate($this->imageAspectRatio);
    }

}
