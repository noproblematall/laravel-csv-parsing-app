<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\CharsetConverter;
use Storage;
use Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Filelist;
use App\Dataset;
use App\Pricing;
use Str;
use App\Notifications\ContactUs;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $processor;

    public function __construct(ProcessController $processor) {
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
        $subpage = 'Working Area';
        
        return view('upload', compact('index','menu','subpage'));
    }

    public function process(Request $request) {
        $index = "index-1";
        $menu = 'working_area';
        $subpage = 'Working Area';

        return view('getcontact', compact('index','menu','subpage'));
    }

    public function package(Request $request) {
        $index = "none-fixed-footer";
        $menu = 'package';

        $pricings = Pricing::where('active',1)->get();
        $subpage = 'Pricing';

        return view('package', compact('index','menu','pricings','subpage'));
    }

    public function fileUploadPost(Request $request) {
        $filename = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->storeAs(
            'upload/'.Auth::user()->email, $filename
        );

        $empty_header_message = self::Empty_header_validation($path);

        $result = [];

        if($empty_header_message == 'success') {
            $invalid_csv_message = self::None_matching_columns_count($path);
            if($invalid_csv_message == 'success') {
                $csv = Reader::createFromPath(storage_path('app/').$path, 'r');
                $csv->setHeaderOffset(0);
                $header_offset = $csv->getHeaderOffset();
                $header = $csv->getHeader();

                $result['error'] = 'none';
                $result['header'] = $header;
        
                return response()->json($result);
            }
            else {
                $result['error'] = $invalid_csv_message;
                $result['header'] = 'none';

                return response()->json($result);
            }
        }
        else {
            $result['error'] = $empty_header_message;
            $result['header'] = 'none';

            return response()->json($result);
        }
    }

    public function Empty_header_validation($path) {
        $csv = Reader::createFromPath(storage_path('app/').$path, 'r');
        $csv->setHeaderOffset(0);
        $header_offset = $csv->getHeaderOffset();
        $header = $csv->getHeader();
        
        foreach($header as $offset => $item) {
            if($item == "") {
                return 'No headers found in this CSV. The 1st row must contain header information. ie: ADDRESS : CITY : PROVINCE : POSTALCODE';
            }
        }

        return 'success';
    }

    public function None_matching_columns_count($path) {
        $file = fopen(storage_path('app/').$path, 'r');
        
        $arr = fgetcsv($file);
        $header_count = count($arr);

        $csv = Reader::createFromPath(storage_path('app/').$path, 'r');
        $length = count($csv);

        $row = 1;
        while (($data = fgetcsv($file, $length, ",")) !== FALSE) {
            $each_records_count = count($data);
            if($header_count != $each_records_count) {
                fclose($file);
                return 'This CSV file does not conform to column data integrity. Columns and data must have the same number of columns to data ratio.';
            }
            
            $row++;
        }
        
        fclose($file);
        return 'success';
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
        }

        $file_info[count($file)] = Dataset::get(['id','name']);
        if(null !== Auth::user()->pricing) {
            $current_plan = Auth::user()->package->rows;
            if(null !== Auth::user()->processed) {
                $file_info[count($file)+1] = Auth::user()->package->rows - Auth::user()->processed;
            }
            else {
                $file_info[count($file)+1] = Auth::user()->package->rows - 0;
            }
        }
        else {
            $file_info[count($file)+1] = 0;
        }

        return response()->json($file_info);
    }
    
    public function processor(Request $requrest) {
        $process_info = $requrest->get('process_info');

        $total_process_rows = 0;

        if(null !== Auth::user()->pricing) {
            $current_plan = Auth::user()->package->rows;
            if(null !== Auth::user()->processed) {
                $processable_rows = Auth::user()->package->rows - Auth::user()->processed;
            }
            else {
                $processable_rows = Auth::user()->package->rows - 0;
            }
        }
        else {
            $processable_rows = 0;
        }

        foreach($process_info as $item) {
            $total_process_rows += $item['process_count'];
        }

        if($total_process_rows > $processable_rows) {
            return response()->json('exceeded_requests');
        }

        $file_count = 0;
        foreach($process_info as $item) {
            $this_line = Filelist::where([
                ['user_id','=',Auth::user()->id],
                ['filename','=',$item['filename']],
                ['status','=',0]
            ])->orderby('created_at','desc')->first();
            $this_line->process_rows = $item['process_count'];
            $this_line->dataset = $item['dataset'];
            $this_line->table_name = md5($item['filename'].Str::random(40).time());
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
            Filelist::where([
                ['user_id','=',Auth::user()->id],
                ['filename','=',$file['filename']],
                ['status','=',0]
            ])->delete();
        }
        
        session()->forget('header_info');

        echo "success";
    }


    public function info() {
        phpinfo();
    }
}
