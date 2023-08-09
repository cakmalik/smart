<?php

namespace App\View\Components\Navigation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminMenuItem extends Component
{
    public $name;
    public $active;
    public $icon;

    public function __construct($name, $active, $icon)
    {
        $this->name = $name;
        $this->active = $active;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation.admin-menu-item');
    }
}
