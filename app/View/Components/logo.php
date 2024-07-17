<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Joaopaulolndev\FilamentGeneralSettings\Models\GeneralSetting;

class logo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $logo = GeneralSetting::first();

        return view('components.logo',compact('logo'));
    }
}
