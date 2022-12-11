<?php

namespace App\View\Components\LandingPage;

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
        return view('components.landing-page.assets-and-meta');
    }
}
