<?php

namespace App\View\Components\Navs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class Link extends Component
{   
    public string $href;
    public bool $active;
    /**
     * Create a new component instance.
     */
    public function __construct(string $route, array $params = [])
    {
        $this->href = route($route, $params);
        $this->active = Route::currentRouteName() === $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navs.link');
    }
}
