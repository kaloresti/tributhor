<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrefeituraController extends Controller
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

    /**
     * Abre a view principal de prefeituras
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('app/prefeituras/index');
    }

    /**
     * Abre a página de cadastro de prefeituras
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('app/prefeituras/create');
    }
}
