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

class IndexController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','verified','admin']);
    }

    public function index() {
        $index = 'home';
        $title = 'Dashboard';

        $payments = Payments::all();
        $total_earnings = 0;

        foreach($payments as $payment) {
            $total_earnings += $payment->package->price;
        }

        $total_members = User::all()->count()-1;

        $new_members = 0;
        $new_members = User::where('active',0)->get()->count();

        $datasets_count = Dataset::all()->count();

        $processes = Filelist::orderby('created_at','desc')->take(10)->get();

        $total_dataset_amount = 0;
        $datasets = Dataset::all();
        foreach($datasets as $dataset) {
            $table = $dataset->first_table;
            $total_dataset_amount += DB::table($table)->get()->count();
        }

        $completed_processes = Filelist::where('status','=',1)->get()->count();
        $in_progress_processes = Filelist::where('status','=',0)->get()->count();
        $total_payments = Payments::all()->count();

        return view('admin.index', compact('index','title','total_earnings','total_members','new_members','datasets_count','processes','total_dataset_amount','completed_processes','in_progress_processes','total_payments'));
    }

    public function download(Request $request) {
        $download_token = $request->get('_download_token');

        $filelist = Filelist::where([
            ['status','=',1]
        ])->get();

        foreach($filelist as $file) {
            if($download_token == $file['table_name']) {
                return response()->download(storage_path('app/processed/'.$file->user->email.'/'.$file['table_name'].'.csv'));
            }
        }
        
        return abort(404);
    }

    public function report_download(Request $request) {
        $download_token = $request->get('_download_token');

        $filelist = Filelist::where([
            ['status','=',1]
        ])->get();

        foreach($filelist as $file) {
            if($download_token == $file['table_name']) {
                return response()->download(storage_path('app/report/'.$file->user->email.'/'.$file['table_name'].'.csv'));
            }
        }
        
        return abort(404);
    }

    public function test() {
        $load = sys_getloadavg();
        return $load[0];
    }
}
