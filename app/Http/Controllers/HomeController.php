<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use League\Csv\Reader;
use Storage;
use App\Middle;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
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

    public function fileUploadPost(Request $request) {
        $path = $request->file('file')->store('upload');

        return $path;
    }

    public function get_file_info(Request $request) {
        $user_id =  Auth::user()->id;
        $filename = $request->_file;
        $csv = Reader::createFromPath(storage_path('app/upload/').$filename, 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();
        
        foreach ($records as $offset => $record) {
            Middle::firstOrCreate([
                'user_id' => $user_id,
                'address' => $record['address'],
                'city' => $record['city'],
                'province' => $record['province'],
                'postal code' => $record['postal code'],
            ]);
        }
        echo count($csv);
    }

    public function processCancel(Request $request) {
        session()->forget('file');

        echo "success";
    }
}
