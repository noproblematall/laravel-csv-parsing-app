<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function upload() {
        $index = "index-1";
        $menu = 'working_area';
        
        return view('upload', compact('index','menu'));
    }
    public function process(Request $request) {
        $file = session('file');
        
        $index = "index-1";
        $menu = 'working_area';
        return view('getcontact', compact('index','menu'));
    }

    public function get_file_info(Request $request) {
        echo $request->_file;
    }

    public function processCancel(Request $request) {
        session()->forget('file');
        
        echo "success";
    }
}
