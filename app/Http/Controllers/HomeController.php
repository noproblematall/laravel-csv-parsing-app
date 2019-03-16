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
        $index = "index-1";
        $menu = 'working_area';
        return view('getcontact', compact('index','menu'));
    }

    public function fileUploadPost(Request $request) {
        $filename = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->storeAs(
            'upload/'.Auth::user()->email, $filename
        );

        $csv = Reader::createFromPath(storage_path('app/').$path, 'r');
        $csv->setHeaderOffset(0);
        $header_offset = $csv->getHeaderOffset();
        $header = $csv->getHeader();

        return $header;
    }

    public function setHeader(Request $request) {
        session()->put('header_info',$request->get('header_info'));
        echo "success";
    }

    public function get_file_info(Request $request) {
        $file = session('header_info');
        $file_info = [];
        for($i=0; $i<count($file); $i++) {
            $csv = Reader::createFromPath(storage_path('app/upload/').Auth::user()->email.'/'.$file[$i]['fileName'], 'r');
            $file_info[$i]['count'] = count($csv);
            $file_info[$i]['fileName'] = $file[$i]['fileName'];
            $file_info[$i]['processable'] = 10000;
        }

        // $user_id =  Auth::user()->id;
        // $filename = $request->_file;
        // $csv = Reader::createFromPath(storage_path('app/upload/').$filename, 'r');
        // $csv->setHeaderOffset(0);
        // $records = $csv->getRecords();
        
        // foreach ($records as $offset => $record) {
        //     Middle::firstOrCreate([
        //         'user_id' => $user_id,
        //         'address' => $record['address'],
        //         'city' => $record['city'],
        //         'province' => $record['province'],
        //         'postal code' => $record['postal code'],
        //     ]);
        // }
        return response()->json($file_info);
    }

    public function processCancel(Request $request) {
        session()->forget('header_info');

        echo "success";
    }
}
