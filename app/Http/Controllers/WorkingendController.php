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
use Route;
use Geocoder;
use Illuminate\Support\Arr;

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

        $writer->insertOne((array)self::get_table_columnName($table));

        for($i=0; $i<count($results); $i++) {
            $arr = (array)$results[$i];
            array_shift($arr);
            $writer->insertOne($arr);
        }
        
        self::end_process($filelist);
        self::sendMail($filelist);

        return "success";
    }

    private function get_table_columnName($table) {
        $columns = DB::table($table)->getConnection()
        ->getSchemaBuilder()
        ->getColumnListing($table);

        array_shift($columns);
        return $columns;
    }

    private function sendMail($filelist) {
        $user = Auth::user();
        $user->notify(new ProcessCompleted($filelist));
    }

    private function end_process($filelist) {

        Filelist::where('id',$filelist->id)->update(['status' => '1']);

        self::report($filelist);

        Schema::dropIfExists($filelist->table_name);

        File::delete(storage_path().'/app/upload/'.$filelist->user->email.'/'.$filelist->filename);

    }

    private function report($filelist) {
        $table = $filelist->table_name;

        $result = [];
        
        $i = 0;
        while(DB::table($table)->count()) {
            $temp = DB::table($table)->first();
            $cons_temp = $temp->ConstituencyName;

            $frequency = DB::table($table)->where('ConstituencyName','=',$cons_temp)->count();
            $result[$i]['frequency'] = $frequency;
            $result[$i]['salutation'] = $temp->SalutationEng;
            $result[$i]['f_name'] = $temp->ParlFirstName;
            $result[$i]['l_name'] = $temp->ParlLastName;
            $result[$i]['constituency'] = $temp->ConstituencyName;
            $result[$i]['party'] = $temp->PartyShortTitle;
            $frequency = DB::table($table)->where('ConstituencyName','=',$cons_temp)->delete();
            $i++;
        }

        $sorted = array_reverse(Arr::sort($result));

        $path = storage_path().'/app/report/'.$filelist->user->email;
        File::makeDirectory($path, $mode = 0777, true, true);

        $encoder = (new CharsetConverter())
        ->inputEncoding('utf-8')
        ->outputEncoding('iso-8859-15');

        $writer = Writer::createFromPath(storage_path('app/report/').$filelist->user->email.'/'.$filelist->table_name.'.csv', 'w+');
        $writer->addFormatter($encoder);

        $header = ['Salutation','First Name','Last Name','Constituency Name','Party','Totals'];

        $writer->insertOne($header);

        for($i=0; $i<count($sorted); $i++) {
            $arr = $sorted[$i];
            $writer->insertOne([ $arr['salutation'],$arr['f_name'],$arr['l_name'],$arr['constituency'],$arr['party'],$arr['frequency'] ]);
        }
    }

    public function test() {
        $filelist = Filelist::first();
        $table = $filelist->table_name;

        $result = [];
        
        $i = 0;
        while(DB::table($table)->count()) {
            $temp = DB::table($table)->first();
            $cons_temp = $temp->ConstituencyName;

            $frequency = DB::table($table)->where('ConstituencyName','=',$cons_temp)->count();
            $result[$i]['frequency'] = $frequency;
            $result[$i]['salutation'] = $temp->SalutationEng;
            $result[$i]['f_name'] = $temp->ParlFirstName;
            $result[$i]['l_name'] = $temp->ParlLastName;
            $result[$i]['constituency'] = $temp->ConstituencyName;
            $result[$i]['party'] = $temp->PartyShortTitle;
            $frequency = DB::table($table)->where('ConstituencyName','=',$cons_temp)->delete();
            $i++;
        }

        $sorted = array_reverse(Arr::sort($result));

        $path = storage_path().'/app/report/'.$filelist->user->email;
        File::makeDirectory($path, $mode = 0777, true, true);

        $encoder = (new CharsetConverter())
        ->inputEncoding('utf-8')
        ->outputEncoding('iso-8859-15');

        $writer = Writer::createFromPath(storage_path('app/report/').$filelist->user->email.'/'.$filelist->table_name.'.csv', 'w+');
        $writer->addFormatter($encoder);

        $header = ['Salutation','First Name','Last Name','Constituency Name','Party','Totals'];

        $writer->insertOne($header);

        for($i=0; $i<count($sorted); $i++) {
            $arr = $sorted[$i];
            $writer->insertOne([ $arr['salutation'],$arr['f_name'],$arr['l_name'],$arr['constituency'],$arr['party'],$arr['frequency'] ]);
        }
    }

    public function download(Request $request) {
        $download_token = $request->get('_download_token');

        $filelist = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',1]
        ])->get();

        foreach($filelist as $file) {
            if($download_token == $file['table_name']) {
                return response()->download(storage_path('app/processed/'.Auth::user()->email.'/'.$file['table_name'].'.csv'));
            }
        }
        
        return abort(404);
    }

    public function report_download(Request $request) {
        $download_token = $request->get('_download_token');

        $filelist = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',1]
        ])->get();

        foreach($filelist as $file) {
            if($download_token == $file['table_name']) {
                return response()->download(storage_path('app/report/'.Auth::user()->email.'/'.$file['table_name'].'.csv'));
            }
        }
        
        return abort(404);
    }

    public function test1() {
        $user = Auth::user();
        $filelist = Filelist::where('user_id','=',Auth::user()->id)->first();
        $user->notify(new ProcessCompleted($filelist));
    }

    public function test2() {

        $address = "909, boul. Mgr de Laval";
        $city = "Baie-Saint-Paul";
        $province = 'QC';
        $postalcode = 'G3Z2V9';

        $query_str = $address.','.$city.','.$province.','.$postalcode;

        $coordinates = Geocoder::getCoordinatesForAddress($query_str);
        
        $coordinate = '('.$coordinates['lng'].' '.$coordinates['lat'].')';

        $first = [];
        $first['first'] = 'without removing special charaters';
        $first['query_str'] = $query_str;
        $first['coordinate'] = $coordinate;

        // ---------------------------------------------------------------//
        $address = preg_replace("/[^a-zA-Z0-9 \-'{}]/", "", $address);
        $city = preg_replace("/[^a-zA-Z0-9 \-'{}]/", "", $city);
        $province = preg_replace("/[^a-zA-Z0-9 \-'{}]/", "", $province);
        $postalcode = preg_replace("/[^a-zA-Z0-9 \-'{}]/", "", $postalcode);

        $query_str = trim($address).','.trim($city).','.trim($province).','.trim($postalcode);

        $coordinates = Geocoder::getCoordinatesForAddress($query_str);
        
        $coordinate = '('.$coordinates['lng'].' '.$coordinates['lat'].')';

        $second = [];
        $second['second'] = 'removing special charaters';
        $second['query_str'] = $query_str;
        $second['coordinate'] = $coordinate;

        $result = [];
        $result[0] = $first;
        $result[1] = $second;
        
        return response()->json($result);
    }
}
