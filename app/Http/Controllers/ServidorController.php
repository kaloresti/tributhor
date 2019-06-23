<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServidorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
        return view('app/servidores/list');
    }
}
