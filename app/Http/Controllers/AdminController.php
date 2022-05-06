<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Publication_about_animal;
use Illuminate\Support\Facades\View;

class AdminController extends AbstractController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $publications = Publication_about_animal::all();

        return view('admin', ['publications' => $publications]);
    }
}
