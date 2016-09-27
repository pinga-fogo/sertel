<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function send503(){
        return view('errors/503');
    }

    public function sendNotFound(){
        return view('errors/notfound');
    }
}
