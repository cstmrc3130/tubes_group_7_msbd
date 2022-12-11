<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class AssetsAndMeta extends Component
{
    public $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('components.dashboard.assets-and-meta');
    }
}
