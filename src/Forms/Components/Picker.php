<?php

namespace Icetalker\FilamentPicker\Forms\Components;

use Closure;
use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Forms\Components\Field;
use Filament\Support\Concerns\HasAlignment;
use Filament\Support\Concerns\HasExtraAlpineAttributes;

class Picker extends Field
{
    use HasOptions;
    use HasExtraAlpineAttributes;
    use HasAlignment;

    protected string $view = 'filament-picker::picker';

    protected array | Closure $icons = [];

    protected array | Closure $images = [];

    protected int | Closure | null $imageSize = null;

    protected bool | Closure $imageOnly = false;

    protected bool|Closure $multiple = false;

    protected string|Closure $backgroundColor = 'bg-white dark:bg-gray-800';

    protected string|Closure $activeBackgroundColor = 'bg-primary-500';

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function backgroundColor(string | Closure $color): static
    {
        $this->backgroundColor = $color;

        return $this;
    }

    public function activeBackgroundColor(string | Closure $color): static
    {
        $this->activeBackgroundColor = $color;

        return $this;
    }

    public function getBackgroundColor(): string
    {
        return (string)$this->evaluate($this->backgroundColor);
    }

    public function getActiveBackgroundColor(): string
    {
        return (string)$this->evaluate($this->activeBackgroundColor);
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

    public function getImageSize(): int
    {
        return (int)$this->evaluate($this->imageSize);
    }

    public function imageOnly(bool | Closure $condition = true){
        $this->imageOnly = $condition;
        return $this;
    }

    public function getImageOnly(){
        return $this->evaluate($this->imageOnly);
    }

    public function multiple(bool|Closure $multiple = true)
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function getMultiple(){
        return $this->evaluate($this->multiple);
    }
}
