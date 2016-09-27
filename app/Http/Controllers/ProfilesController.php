<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    public function index(){
        return view('admin.profiles.list');
    }
    public function create(){
        return view('admin.profiles.create');
    }
    public function store(){
        return view('admin.profiles.create');
    }
    public function update(){
        return view('admin.profiles.update');
    }
}
