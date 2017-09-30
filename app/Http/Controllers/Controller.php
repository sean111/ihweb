<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    private $templateVars = [];
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function view(string $view, array $params = [])
    {
        return view($view, array_merge($params, $this->templateVars));
    }

    public function addBreadcrumb(string $name, string $route = null, string $icon = null)
    {
        $this->templateVars['breadcrumb'][] = ['name' => $name, 'route' => $route, 'icon' => $icon];
        return $this;
    }
}
