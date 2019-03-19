<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use League\Csv\Reader;
use League\Csv\CharsetConverter;
use Storage;
use Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Filelist;
use App\Dataset;
use App\Middle;
use DB;

class ProcessController extends Controller
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

    public function original_csv_store_db() {
        $file_count = 2;
        $filelist = Filelist::where('user_id','=',Auth::user()->id)->orderby('created_at')->take($file_count)->get();

        foreach($filelist as $item) {
            $path = $item->user->email.'/'.$item->filename;
            self::make_csv_dbtable($path, $item->table_name);
            self::store_csv_db($path, $item->table_name, $item->process_rows);
        }
        
        // return response()->json($filelist);
    }

    public function make_csv_dbtable($path, $table_name) {
        $csv = Reader::createFromPath(storage_path('app/upload/').$path, 'r');
        $csv->setHeaderOffset(0);
        $header_offset = $csv->getHeaderOffset();
        $header = $csv->getHeader();

        Schema::dropIfExists($table_name);
        Schema::create($table_name, function (Blueprint $table) use ($header) {
            $table->bigIncrements('id');
            foreach($header as $header_column) {
                $table->string($header_column)->nullable();
            }
        });
    }

    public function store_csv_db($path, $table_name, $limit) {
        $csv = Reader::createFromPath(storage_path('app/upload/').$path, 'r');
        $csv->setHeaderOffset(0);
        $header_offset = $csv->getHeaderOffset();
        $header = $csv->getHeader();
        $records = $csv->getRecords();

        $encoder = (new CharsetConverter())->inputEncoding('iso-8859-15');
        $records = $encoder->convert($records);

        foreach ($records as $offset => $record) {
            if($offset > $limit) {
                break;
            }
            $sql = [];
            for($i = 0; $i < count($header); $i++) {
                $sql[$header[$i]] = $record[$header[$i]];
            }

            DB::table($table_name)->insert($sql);
        }
    }
}
