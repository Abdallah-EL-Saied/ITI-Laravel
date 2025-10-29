<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public function __construct(
        public ?string $href = null,
        public string $type = 'primary',
        public string $size = 'md',
        public ?string $icon = null,
        public ?string $extra = null // optional extra classes
    ) {
    }

    public function render()
    {
        return view('components.button');
    }
}
