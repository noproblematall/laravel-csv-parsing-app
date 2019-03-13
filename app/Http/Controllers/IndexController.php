<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __contruct() {

    }

    public function index() {
        $index = "index";
        $menu = '';
        return view('index', compact('index','menu'));
    }

    public function upload() {
        $index = "index-1";
        $menu = 'working_area';
        return view('upload', compact('index','menu'));
    }
}
