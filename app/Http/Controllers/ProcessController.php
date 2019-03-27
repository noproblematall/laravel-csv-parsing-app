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
use App\User;
use DB;
use Geocoder;

class ProcessController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $workingender;

    public function __construct(WorkingendController $workingender)
    {
        $this->middleware(['auth','verified']);
        $this->workingender = $workingender;
    }

    public function original_csv_store_db() {

        $file_count = count(session('header_info'));

        $filelist = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',0]
        ])->orderby('created_at','desc')->take($file_count)->get();

        foreach($filelist as $item) {
            $path = $item->user->email.'/'.$item->filename;
            self::make_csv_dbtable($path, $item->table_name);
            self::store_csv_db($path, $item->table_name, $item->process_rows);
            self::getCoordinates($item);

            $result = $this->workingender->store_result_as_csv($item);
            if($result == 'success') {
                self::subtract_processed_rows($item->process_rows);
            }
        }
        
        return response()->json($filelist);
    }

    private function subtract_processed_rows($rows) {
        $current_rows = Auth::user()->processed;
        $total_rows = $current_rows + $rows;
        $user = User::where('id',Auth::user()->id)->first();
        $user->processed = $total_rows;
        $user->save();

        return 'success';
    }

    private function make_csv_dbtable($path, $table_name) {
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

    private function store_csv_db($path, $table_name, $limit) {
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

    private function getCoordinates($item) {
        $address = $item->address;
        $city = $item->city;
        $province = $item->province;
        $postalcode = $item->postalcode;

        self::Add_result_column($item);

        DB::table($item->table_name)->select('id',$address,$city,$province,$postalcode)->orderBy('id')->chunk(100, function ($results) use($item,$address,$city,$province,$postalcode) {
            foreach($results as $addr) {
                $addr = (array)$addr;

                $ad = preg_replace("/[^a-zA-Z0-9 \-'{}]/", "", $addr[$address]);
                $ct = preg_replace("/[^a-zA-Z0-9 \-'{}]/", "", $addr[$city]);
                $pv = preg_replace("/[^a-zA-Z0-9 \-'{}]/", "", $addr[$province]);
                $pc = preg_replace("/[^a-zA-Z0-9 \-'{}]/", "", $addr[$postalcode]);

                $query_str = trim($ad).','.trim($ct).','.trim($pv).','.trim($pc);

                $coordinates = Geocoder::getCoordinatesForAddress($query_str);
                
                $coordinate = '('.$coordinates['lng'].' '.$coordinates['lat'].')';
    
                self::getData($addr['id'],$item,$coordinate);
            }
        });
    }

    private function Add_result_column($item) {

        $columns = self::get_table_culumnName($item->mydataset->second_table);
        
        for($i=1; $i<count($columns); $i++) {
            $column = $columns[$i];
            Schema::table($item->table_name, function($table) use($column) {
                $table->string($column);
            });
        }
    }

    private function getData($id,$item,$coordinate) {
        
        $riding = DB::table($item->mydataset->first_table)
        ->select($item->mydataset->first_keyword)->orderby('polygon','asc')
        ->whereRaw("ST_CONTAINS(polygon, ST_GEOMFROMTEXT('POINT".$coordinate."'))")
        ->first();
        
        if($riding != null) {
            $riding = (array)$riding;
            $constituencyName = $riding[$item->mydataset->first_keyword];

            $added_values = DB::table($item->mydataset->second_table)
            ->where($item->mydataset->second_keyword,'=',$constituencyName)
            ->first();

            if($added_values != null) {
                $added_values = (array)$added_values;

                DB::table($item->table_name)->where('id','=',$id)
                ->update([
                    'ParlLastName' => $added_values['ParlLastName'],
                    'ParlFirstName' => $added_values['ParlFirstName'],
                    'SalutationEng' => $added_values['SalutationEng'],
                    'SalutationFr' => $added_values['SalutationFr'],
                    'SalutationLtrE' => $added_values['SalutationLtrE'],
                    'SalutationLtrF' => $added_values['SalutationLtrF'],
                    'TitleAbbEng' => $added_values['TitleAbbEng'],
                    'TitleAbbFr' => $added_values['TitleAbbFr'],
                    'InitialEng' => $added_values['InitialEng'],
                    'InitialFr' => $added_values['InitialFr'],
                    'ConstituencyName' => $added_values['ConstituencyName'],
                    'ConstituencyNameFr' => $added_values['ConstituencyNameFr'],
                    'ProvinceEng' => $added_values['ProvinceEng'],
                    'ProvinceFr' => $added_values['ProvinceFr'],
                    'BuildingName' => $added_values['BuildingName'],
                    'BuildingNameFr' => $added_values['BuildingNameFr'],
                    'BuildingProvinceEN' => $added_values['BuildingProvinceEN'],
                    'BuildingProvinceFR' => $added_values['BuildingProvinceFR'],
                    'BuildingCityEN' => $added_values['BuildingCityEN'],
                    'BuildingCityFR' => $added_values['BuildingCityFR'],
                    'BuildingPostalCode' => $added_values['BuildingPostalCode'],
                    'HillAddPhone' => $added_values['HillAddPhone'],
                    'HillAddFax' => $added_values['HillAddFax'],
                    'PartyShortTitle' => $added_values['PartyShortTitle'],
                    'PartyShortTitleFr' => $added_values['PartyShortTitleFr'],
                    'PartyAbbEng' => $added_values['PartyAbbEng'],
                    'PartyAbbFr' => $added_values['PartyAbbFr'],
                    'LanguagePreference' => $added_values['LanguagePreference'],
                    'PreferenceLinguistique' => $added_values['PreferenceLinguistique'],
                    'Email:' => $added_values['Email:'],
                ]);
            }
            else {
                DB::table($item->table_name)->where('id','=',$id)
                ->update([
                    'ParlLastName' => 'INFORMATION NOT FOUND',
                    'ParlFirstName' => 'INFORMATION NOT FOUND',
                    'SalutationEng' => 'INFORMATION NOT FOUND',
                    'SalutationFr' => 'INFORMATION NOT FOUND',
                    'SalutationLtrE' => 'INFORMATION NOT FOUND',
                    'SalutationLtrF' => 'INFORMATION NOT FOUND',
                    'TitleAbbEng' => 'INFORMATION NOT FOUND',
                    'TitleAbbFr' => 'INFORMATION NOT FOUND',
                    'InitialEng' => 'INFORMATION NOT FOUND',
                    'InitialFr' => 'INFORMATION NOT FOUND',
                    'ConstituencyName' => 'INFORMATION NOT FOUND',
                    'ConstituencyNameFr' => 'INFORMATION NOT FOUND',
                    'ProvinceEng' => 'INFORMATION NOT FOUND',
                    'ProvinceFr' => 'INFORMATION NOT FOUND',
                    'BuildingName' => 'INFORMATION NOT FOUND',
                    'BuildingNameFr' => 'INFORMATION NOT FOUND',
                    'BuildingProvinceEN' => 'INFORMATION NOT FOUND',
                    'BuildingProvinceFR' => 'INFORMATION NOT FOUND',
                    'BuildingCityEN' => 'INFORMATION NOT FOUND',
                    'BuildingCityFR' => 'INFORMATION NOT FOUND',
                    'BuildingPostalCode' => 'INFORMATION NOT FOUND',
                    'HillAddPhone' => 'INFORMATION NOT FOUND',
                    'HillAddFax' => 'INFORMATION NOT FOUND',
                    'PartyShortTitle' => 'INFORMATION NOT FOUND',
                    'PartyShortTitleFr' => 'INFORMATION NOT FOUND',
                    'PartyAbbEng' => 'INFORMATION NOT FOUND',
                    'PartyAbbFr' => 'INFORMATION NOT FOUND',
                    'LanguagePreference' => 'INFORMATION NOT FOUND',
                    'PreferenceLinguistique' => 'INFORMATION NOT FOUND',
                    'Email:' => 'INFORMATION NOT FOUND',
                ]);
            }
        }
        else {
            DB::table($item->table_name)->where('id','=',$id)
            ->update([
                'ParlLastName' => 'INFORMATION NOT FOUND',
                'ParlFirstName' => 'INFORMATION NOT FOUND',
                'SalutationEng' => 'INFORMATION NOT FOUND',
                'SalutationFr' => 'INFORMATION NOT FOUND',
                'SalutationLtrE' => 'INFORMATION NOT FOUND',
                'SalutationLtrF' => 'INFORMATION NOT FOUND',
                'TitleAbbEng' => 'INFORMATION NOT FOUND',
                'TitleAbbFr' => 'INFORMATION NOT FOUND',
                'InitialEng' => 'INFORMATION NOT FOUND',
                'InitialFr' => 'INFORMATION NOT FOUND',
                'ConstituencyName' => 'INFORMATION NOT FOUND',
                'ConstituencyNameFr' => 'INFORMATION NOT FOUND',
                'ProvinceEng' => 'INFORMATION NOT FOUND',
                'ProvinceFr' => 'INFORMATION NOT FOUND',
                'BuildingName' => 'INFORMATION NOT FOUND',
                'BuildingNameFr' => 'INFORMATION NOT FOUND',
                'BuildingProvinceEN' => 'INFORMATION NOT FOUND',
                'BuildingProvinceFR' => 'INFORMATION NOT FOUND',
                'BuildingCityEN' => 'INFORMATION NOT FOUND',
                'BuildingCityFR' => 'INFORMATION NOT FOUND',
                'BuildingPostalCode' => 'INFORMATION NOT FOUND',
                'HillAddPhone' => 'INFORMATION NOT FOUND',
                'HillAddFax' => 'INFORMATION NOT FOUND',
                'PartyShortTitle' => 'INFORMATION NOT FOUND',
                'PartyShortTitleFr' => 'INFORMATION NOT FOUND',
                'PartyAbbEng' => 'INFORMATION NOT FOUND',
                'PartyAbbFr' => 'INFORMATION NOT FOUND',
                'LanguagePreference' => 'INFORMATION NOT FOUND',
                'PreferenceLinguistique' => 'INFORMATION NOT FOUND',
                'Email:' => 'INFORMATION NOT FOUND',
            ]);
        }
    }

    private function get_table_culumnName($table) {
        $columns = DB::table($table)->getConnection()
        ->getSchemaBuilder()
        ->getColumnListing($table);

        return $columns;
    }

    public function test() {
        $table_name = 'test';
        $coordinate = '(10 10)';
        $field = 'name';

        $riding = DB::table($table_name)
        ->select('id','name')->orderby('polygon','asc')
        ->whereRaw("ST_CONTAINS(polygon, ST_GEOMFROMTEXT('POINT".$coordinate."'))")
        ->first();

        if($riding != null) {
            $riding = (array)$riding;
            dump($riding['id']);
            dump($riding['name']);
        }
        else {
            dump($riding);
        }
    }

    public function test1() {
        $table_name = 'parliamentlist';

        $rr = self::get_table_culumnName($table_name);

        return response()->json($rr);
    }

    public function test2() {
        $table_name = '76b4b33633da7e29b9012d9d2f851db3';

        DB::table($table_name)
        ->update([
            'ParlLastName' => 'INFORMATION NOT FOUND',
            'ParlFirstName' => 'INFORMATION NOT FOUND',
            'SalutationEng' => 'INFORMATION NOT FOUND',
            'SalutationFr' => 'INFORMATION NOT FOUND',
            'SalutationLtrE' => 'INFORMATION NOT FOUND',
            'SalutationLtrF' => 'INFORMATION NOT FOUND',
            'TitleAbbEng' => 'INFORMATION NOT FOUND',
            'TitleAbbFr' => 'INFORMATION NOT FOUND',
            'InitialEng' => 'INFORMATION NOT FOUND',
            'InitialFr' => 'INFORMATION NOT FOUND',
            'ConstituencyName' => 'INFORMATION NOT FOUND',
            'ConstituencyNameFr' => 'INFORMATION NOT FOUND',
            'ProvinceEng' => 'INFORMATION NOT FOUND',
            'ProvinceFr' => 'INFORMATION NOT FOUND',
            'BuildingName' => 'INFORMATION NOT FOUND',
            'BuildingNameFr' => 'INFORMATION NOT FOUND',
            'BuildingProvinceEN' => 'INFORMATION NOT FOUND',
            'BuildingProvinceFR' => 'INFORMATION NOT FOUND',
            'BuildingCityEN' => 'INFORMATION NOT FOUND',
            'BuildingCityFR' => 'INFORMATION NOT FOUND',
            'BuildingPostalCode' => 'INFORMATION NOT FOUND',
            'HillAddPhone' => 'INFORMATION NOT FOUND',
            'HillAddFax' => 'INFORMATION NOT FOUND',
            'PartyShortTitle' => 'INFORMATION NOT FOUND',
            'PartyShortTitleFr' => 'INFORMATION NOT FOUND',
            'PartyAbbEng' => 'INFORMATION NOT FOUND',
            'PartyAbbFr' => 'INFORMATION NOT FOUND',
            'LanguagePreference' => 'INFORMATION NOT FOUND',
            'PreferenceLinguistique' => 'INFORMATION NOT FOUND',
            'Email:' => 'INFORMATION NOT FOUND',
        ]);
    }
}
