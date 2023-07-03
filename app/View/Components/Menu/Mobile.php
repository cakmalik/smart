<?php

namespace App\View\Components\Menu;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Mobile extends Component
{
    public $link;
    public $label;
    public function __construct($link, $label)
    {
        $this->link = $link;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu.mobile');
    }
}
