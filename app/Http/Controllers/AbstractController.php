<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Facades\View;

class AbstractController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $categories = Categories::all();

        View::share('categories', $categories);
    }

}
