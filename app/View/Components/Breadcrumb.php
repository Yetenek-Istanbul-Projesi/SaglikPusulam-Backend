<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Diglactic\Breadcrumbs\Breadcrumbs;

class Breadcrumb extends Component
{
    public string $currentRoute;
    public array $params;

    public function __construct(string $currentRoute, array $params = [])
    {
        $this->currentRoute = $currentRoute;
        $this->params = $params;
    }

    public function render()
    {
        // Breadcrumb'ları render et
        return Breadcrumbs::render($this->currentRoute, ...$this->params);
    }
}
