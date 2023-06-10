<?php

namespace App\View\Components\Card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Image extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $lineOne;
    public $lineTwo;
    public $buttonText;

    public function __construct($name = 'Tambah', $lineOne = '-', $lineTwo = '-', $buttonText = 'Selengkapnya')
    {
        $this->name = $name;
        $this->lineOne = $lineOne;
        $this->lineTwo = $lineTwo;
        $this->buttonText = $buttonText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card.image');
    }
}
