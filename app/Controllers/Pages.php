<?php

namespace App\Controllers;

class Pages extends BaseController
{
    protected function setViewData(): array
    {
        return [
            'isActive' => function($route) {
                return $this->isActive($route);
            }
        ];
    }

    public function index(): string
    {
        return view('pages/dashboard', $this->setViewData());
    }

    public function sop(): string
    {
        return view('pages/sop', $this->setViewData());
    }

    public function orders(): string
    {
        return view('pages/order', $this->setViewData());
    }
}