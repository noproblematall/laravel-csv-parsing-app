<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __contruct() {

    }

    public function index() {
        $index = "index";
        return view('index', compact('index'));
    }

    public function upload() {
        $index = "index-1";
        return view('upload', compact('index'));
    }
}
