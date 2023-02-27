<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Success extends Component
{
    public $messages;

    /**
     * Create a new component instance.
     */
    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.success');
    }
}
