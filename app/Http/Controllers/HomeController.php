<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use League\Csv\Reader;
use Storage;
use Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Filelist;
use App\Dataset;
use App\Middle;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $processor;

    public function __construct(ProcessController $processor)
    {
        $this->middleware(['auth','verified']);
        $this->processor = $processor;
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
    public function info() {
        phpinfo();
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

        foreach($header_info as $item) {
            Filelist::create([
                'user_id' => Auth::user()->id,
                'filename' => $item['filename'],
                'address' => $item['address'],
                'city' => $item['city'],
                'province' => $item['province'],
                'postalcode' => $item['postalcode'],
                'status' => 0
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

        return response()->json($file_info);
    }
    
    public function processor(Request $requrest) {
        $process_info = $requrest->get('process_info');

        $file_count = 0;
        foreach($process_info as $item) {
            $this_line = Filelist::where([
                ['user_id','=',Auth::user()->id],
                ['filename','=',$item['filename']]
            ])->first();
            $this_line->process_rows = $item['process_count'];
            $this_line->dataset = $item['dataset'];
            $this_line->table_name = md5($item['filename']);
            $this_line->save();
            $file_count++;
        }

        $result = $this->processor->original_csv_store_db($file_count);

        session()->forget('header_info');

        return $result;
    }

    public function test() {
        $file = session('header_info');

        return response()->json($file);
    }

    public function processCancel(Request $request) {
        $filelist = session()->get('header_info');
        foreach($filelist as $file) {
            $tableName = Filelist::where([
                ['user_id','=',Auth::user()->id],
                ['filename','=',$file['filename']]
            ])->first()->table_name;
            Schema::dropIfExists($tableName);

            Filelist::where([
                ['user_id','=',Auth::user()->id],
                ['filename','=',$file['filename']]
            ])->delete();
        }
        
        session()->forget('header_info');

        echo "success";
    }
}
