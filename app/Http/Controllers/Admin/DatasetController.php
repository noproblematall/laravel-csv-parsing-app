<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Filelist;
use App\Payments;
use App\Pricing;
use App\User;
use App\Dataset;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class DatasetController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','verified','admin']);
    }

    public function index() {
        $index = 'dataset';
        $title = 'Dataset management';

        return view('admin.dataset', compact('index','title'));
    }

    public function get() {
        $datasets = Dataset::all();

        $result = [];
        $result['data'] = [];
        $i = 0;
        foreach($datasets as $dataset) {
            $result['data'][$i][0] = $i+1;
            $result['data'][$i][1] = "<span class='dataset_id'>".$dataset->id."</span>";
            $result['data'][$i][2] = $dataset->name;
            $result['data'][$i][3] = $dataset->first_table;
            $result['data'][$i][4] = $dataset->first_keyword;
            $result['data'][$i][5] = $dataset->second_table;
            $result['data'][$i][6] = $dataset->second_keyword;
            if($dataset->active == 1) {
                $result['data'][$i][7] = "<span class='label label-success inactive'>Active</span>";
            }
            else {
                $result['data'][$i][7] = "<span class='label label-danger inactive'>Inactive</span>";
            }
            $i++;
        }

        return response()->json($result);
    }

    public function add() {
        $index = 'dataset';
        $title = 'Dataset management';

        $tables = self::showTables();

        return view('admin.addDataset', compact('index','title','tables'));
    }

    public function showTables() {
        $db_tables = DB::select('SHOW TABLES');

        $tables = [];
        $i = 0;
        foreach($db_tables as $table) {
            $table = (array)$table;
            $table = $table['Tables_in_'.env('DB_DATABASE')];
            
            if($table != 'datasets' && $table != 'filelists' && $table != 'migrations' && $table != 'password_resets' && $table != 'payments' && $table != 'pricings' && $table != 'settings' && $table != 'users') {
                if( !strpos($table,"_flashtable") ) {
                    $tables[$i] = $table;
                    $i++;
                }
            }
        }

        return $tables;
    }

    public function addPost(Request $request) {
        $dataset = new Dataset;
        $dataset->name = $request->get('name');
        $dataset->first_table = $request->get('first_table');
        $dataset->first_keyword = $request->get('first_table_keyword');
        $dataset->second_table = $request->get('second_table');
        $dataset->second_keyword = $request->get('second_table_keyword');
        $dataset->active = $request->get('active');
        $dataset->save();
        
        return redirect('/admin/dataset');
    }

    public function active(Request $request) {
        $dataset = Dataset::where('id','=',$request->get('dataset_id'))->first();
        $dataset->active = 1;
        $dataset->save();

        return "success";
    }

    public function inactive(Request $request) {
        $dataset = Dataset::where('id','=',$request->get('dataset_id'))->first();
        $dataset->active = 0;
        $dataset->save();

        return "success";
    }

    public function edit(Request $request,$id) {
        $dataset = Dataset::where('id','=',$id)->first();
        $tables = self::showTables();
        $first_table_columns = self::get_table_culumnName($dataset->first_table);
        $second_table_columns = self::get_table_culumnName($dataset->second_table);
        
        $index = 'dataset';
        $title = 'Dataset management';

        return view('admin.editDataset', compact('index','dataset','title','tables','first_table_columns','second_table_columns'));
    }

    public function editPost(Request $request) {
        $dataset = Dataset::where('id','=',$request->get('id'))->first();
        $dataset->name = $request->get('name');
        $dataset->first_table = $request->get('first_table');
        $dataset->first_keyword = $request->get('first_table_keyword');
        $dataset->second_table = $request->get('second_table');
        $dataset->second_keyword = $request->get('second_table_keyword');
        $dataset->active = $request->get('active');
        $dataset->save();
        
        return redirect('/admin/dataset/edit/'.$request->get('id'));
    }

    public function get_table_header(Request $request) {
        $columns = DB::table($request->get('table'))->getConnection()
        ->getSchemaBuilder()
        ->getColumnListing($request->get('table'));

        return response()->json($columns);
    }

    private function get_table_culumnName($table) {
        $columns = DB::table($table)->getConnection()
        ->getSchemaBuilder()
        ->getColumnListing($table);

        return $columns;
    }

    public function delete(Request $request) {
        Dataset::find($request->get('id'))->delete();
        Filelist::where('dataset','=',$request->get('id'))->delete();
        return 'success';
    }
}
