<?php

namespace App\View\Components\Organisms;

use App\Models\Event;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HomeCarousel extends Component
{
    /**
     * Create a new component instance.
     */
    public $events;

    public function __construct()
    {
        //
        $this->events = Event::where('validation', 'approved')
            ->take(6)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.home-carousel');
    }
}
