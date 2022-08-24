<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('visitor.index');
    }

    public function login()
    {
        return view('visitor.login');
    }

    public function science()
    {
        return view('visitor.science');
    }

    public function commerce()
    {
        return view('visitor.commerce');
    }

    public function arts()
    {
        return view('visitor.arts');
    }

    public function engineering()
    {
        return view('visitor.engineering');
    }
}
