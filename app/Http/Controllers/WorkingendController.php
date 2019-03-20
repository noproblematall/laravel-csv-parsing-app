<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use League\Csv\Writer;
use League\Csv\CharsetConverter;
use Storage;
use Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Filelist;
use App\Dataset;
use App\Middle;
use DB;
use File;
use App\Notifications\ProcessCompleted;

class WorkingendController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function store_result_as_csv($filelist) {
        $table = $filelist->table_name;

        $results = DB::table($table)->get();

        $path = storage_path().'/app/processed/'.$filelist->user->email;
        File::makeDirectory($path, $mode = 0777, true, true);

        $encoder = (new CharsetConverter())
        ->inputEncoding('utf-8')
        ->outputEncoding('iso-8859-15');

        $writer = Writer::createFromPath(storage_path('app/processed/').$filelist->user->email.'/'.$filelist->table_name.'.csv', 'w+');
        $writer->addFormatter($encoder);

        $writer->insertOne((array)self::get_table_culumnName($table));

        for($i=0; $i<count($results); $i++) {
            $arr = (array)$results[$i];
            array_shift($arr);
            $writer->insertOne($arr);
        }
        
        self::end_process($filelist);
        self::sendMail();
    }

    private function get_table_culumnName($table) {
        $columns = DB::table($table)->getConnection()
        ->getSchemaBuilder()
        ->getColumnListing($table);

        array_shift($columns);
        return $columns;
    }

    private function sendMail() {
        $user = Auth::user();

        $user->notify(new ProcessCompleted($user));
    }

    private function end_process($filelist) {
        
        Filelist::where('id',$filelist->id)->update(['status' => '1']);

        Schema::drop($filelist->table_name);

        File::delete(storage_path().'/app/upload/'.$filelist->user->email.'/'.$filelist->filename);

    }

    public function test() {
        $table = '76b4b33633da7e29b9012d9d2f851db3';

        $results = DB::table($table)->get();

        $results = $results->toArray();

        $path = storage_path().'/app/processed/david1213117@gmail.com';
        File::makeDirectory($path, $mode = 0777, true, true);

        $encoder = (new CharsetConverter())
        ->inputEncoding('utf-8')
        ->outputEncoding('iso-8859-15');

        $writer = Writer::createFromPath(storage_path('app/processed/david1213117@gmail.com/').'76b4b33633da7e29b9012d9d2f851db3.csv', 'w+');

        $writer->insertOne((array)self::get_table_culumnName($table));
        $writer->addFormatter($encoder);

        for($i=0; $i<count($results); $i++) {
            $arr = (array)$results[$i];
            array_shift($arr);
            $writer->insertOne($arr);
        }

        Filelist::where('id',60)->update(['status' => '1']);
    }

    public function test1() {
        $user = Auth::user();

        $user->notify(new ProcessCompleted($user));
    }
}
