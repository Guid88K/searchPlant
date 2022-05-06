<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends AbstractController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
