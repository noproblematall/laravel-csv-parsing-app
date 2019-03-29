<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pricing;

class IndexController extends Controller
{
    public function __contruct() {

    }

    public function index() {
        $index = "index";
        $menu = '';
        $pricings = Pricing::where('active','=',1)->get();
        return view('index', compact('index','menu','pricings'));
    }
}
