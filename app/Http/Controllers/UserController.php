<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filelist;
use App\Dataset;
use Auth;
use route;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index() {

        $processing_files_count = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',0]
        ])->count();

        $completed_files_count = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',1]
        ])->count();

        $active = 'completed';
        $menu = 'dashboard';
        return view('user.index', compact('active','processing_files_count','completed_files_count','menu'));
    }

    public function personal_info() {
        $processing_files_count = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',0]
        ])->count();

        $completed_files_count = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',1]
        ])->count();

        $active = 'info';
        $menu = 'dashboard';
        return view('user.index', compact('active','processing_files_count','completed_files_count','menu'));
    }

    public function change_pwd() {
        $processing_files_count = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',0]
        ])->count();

        $completed_files_count = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',1]
        ])->count();
        
        $active = 'chang_pwd';
        $menu = 'dashboard';
        return view('user.index', compact('active','processing_files_count','completed_files_count','menu'));
    }

    public function membership() {
        $processing_files_count = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',0]
        ])->count();

        $completed_files_count = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',1]
        ])->count();
        
        $active = 'membership';
        $menu = 'dashboard';
        return view('user.index', compact('active','processing_files_count','completed_files_count','menu'));
    }

    public function getProcessingList() {
        $filelist = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',0]
        ])->get();

        $result = [];
        $result['data'] = [];
        $i = 0;
        foreach($filelist as $item) {
            $result['data'][$i][0] = $i+1;
            $result['data'][$i][1] = $item->filename;
            $result['data'][$i][2] = $item->process_rows;
            $result['data'][$i][3] = $item->mydataset->name;
            $result['data'][$i][4] = 'In process';
            $result['data'][$i][5] = $item->created_at;
            $i++;
        }

        return response()->json($result);
    }

    public function getCompletedList() {
        $filelist = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',1]
        ])->get();

        $result = [];
        $result['data'] = [];
        $i = 0;
        foreach($filelist as $item) {
            $result['data'][$i][0] = $i+1;
            $result['data'][$i][1] = $item->filename;
            $result['data'][$i][2] = $item->process_rows;
            $result['data'][$i][3] = $item->mydataset->name;
            $result['data'][$i][4] = $item->updated_at;
            $result['data'][$i][5] = '<a href="#" class="btn btn-primary download-btn" onclick="event.preventDefault();document.getElementById(\'download-form-'.$item->id.'\').submit();">Download</a>'.
            '<form method="POST" id="download-form-'.$item->id.'" action="'.route('download').'" style="display:none;"><input type="hidden" name="_token" value="'.csrf_token().
            '" /><input type="text" name="_download_token" value="'.$item->table_name.'" /></form>';
            $i++;
        }

        return response()->json($result);
    }

    public function getMobileProcessingList() {
        $filelist = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',0]
        ])->get();

        $result = [];
        $result['data'] = [];
        $i = 0;
        foreach($filelist as $item) {
            $result['data'][$i][0] = $item->filename;
            $result['data'][$i][1] = $item->process_rows;
            $result['data'][$i][2] = $item->mydataset->name;
            $i++;
        }

        return response()->json($result);
    }

    public function getMobileCompletedList() {
        $filelist = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',1]
        ])->get();

        $result = [];
        $result['data'] = [];
        $i = 0;
        foreach($filelist as $item) {
            $result['data'][$i][0] = $item->filename;
            $result['data'][$i][1] = $item->mydataset->name;
            $result['data'][$i][2] = '<a href="#" class="btn btn-primary download-btn" onclick="event.preventDefault();document.getElementById(\'download-form-'.$item->id.'\').submit();">Download</a>'.
            '<form method="POST" id="download-form-'.$item->id.'" action="'.route('download').'" style="display:none;"><input type="hidden" name="_token" value="'.csrf_token().
            '" /><input type="text" name="_download_token" value="'.$item->table_name.'" /></form>';
            $i++;
        }

        return response()->json($result);
    }
}
