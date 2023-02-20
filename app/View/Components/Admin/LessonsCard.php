<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class LessonsCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $lessons,
        public $dayName
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.lessons-card');
    }
}
