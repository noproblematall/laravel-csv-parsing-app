<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use League\Csv\Reader;
use Storage;
use App\Middle;
use Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Filelist;
use App\Dataset;

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
        $header_info = $request->get('header_info');
        session()->put('header_info',$header_info);

        // Schema::create('david', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     for($i=0; $i<5; $i++) {
        //         $table->string('a_'.$i);
        //     }
        // });

        foreach($header_info as $item) {
            Filelist::create([
                'user_id' => Auth::user()->id,
                'filename' => $item['filename'],
                'address' => $item['address'],
                'city' => $item['city'],
                'province' => $item['province'],
                'postalcode' => $item['postalcode']
            ]);
        }

        echo "success";
    }

    public function get_file_info(Request $request) {
        $file = session('header_info');
        $file_info = [];
        for($i=0; $i<count($file); $i++) {
            $csv = Reader::createFromPath(storage_path('app/upload/').Auth::user()->email.'/'.$file[$i]['filename'], 'r');
            $file_info[$i]['count'] = count($csv);
            $file_info[$i]['fileName'] = $file[$i]['filename'];
            $file_info[$i]['processable'] = 10000;
        }

        $file_info[count($file)] = Dataset::get(['id','name']);

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
    
    public function processor(Requrest $requrest) {
        echo 'ddd';
    }

    public function test() {
        $file = session('header_info');

        return response()->json($file);
    }

    public function processCancel(Request $request) {
        $filelist = session()->get('header_info');
        foreach($filelist as $file) {
            Filelist::where([
                ['user_id','=',Auth::user()->id],
                ['filename','=',$file['filename']]
            ])->delete();
        }
        session()->forget('header_info');

        echo "success";
    }
}
