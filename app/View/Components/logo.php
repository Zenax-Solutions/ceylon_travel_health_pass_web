<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Joaopaulolndev\FilamentGeneralSettings\Models\GeneralSetting;

class logo extends Component
{
    public $logo;
    /**
     * Create a new component instance.
     */
    public function __construct($logo =  null)
    {
        $this->logo = $logo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $this->logo = GeneralSetting::first();

        return view('components.logo');
    }
}
