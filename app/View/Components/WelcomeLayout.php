<?php

namespace App\View\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class WelcomeLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function render(): View
    {
        return view('landing-page.layouts.welcome');
    }
}
