<?php

namespace App\View\Components;


use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Joaopaulolndev\FilamentGeneralSettings\Models\GeneralSetting;

class logo extends Component
{
    public $main_logo;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->main_logo = GeneralSetting::first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.logo');
    }
}
