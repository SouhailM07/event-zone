<?php

namespace App\View\Components\Organisms;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventsContainer extends Component
{
    /**
     * Create a new component instance.
     */
    public $eventsByCategory;

    public function __construct()
    {
        //
        $categories = Category::all();
        $this->eventsByCategory = $categories->map(function ($category) {
            return [
                'type' => $category->name, // or slug if you prefer
                'events' => $category->events()->get()->where('validation', 'approved'), // assuming you have a relation
            ];
        })->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.events-container');
    }
}
