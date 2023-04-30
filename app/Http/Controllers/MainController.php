<?php

namespace App\Http\Controllers;

class MainController
{
    public function invoke(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('main');
    }
}
