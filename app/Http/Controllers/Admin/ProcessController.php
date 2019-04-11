<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Filelist;

class ProcessController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','verified','admin']);
    }

    public function index() {
        $index = 'process';
        $title = 'Process management';
        return view('admin.process', compact('index','title'));
    }

    public function get(Request $request) {
        $filelist = Filelist::all();

        $result = [];
        $result['data'] = [];
        $i = 0;
        foreach($filelist as $item) {
            $result['data'][$i][0] = $i+1;
            $result['data'][$i][1] = "<span class='process_id'>".$item->id."</span>";
            $result['data'][$i][2] = $item->user->f_name.' '.$item->user->l_name;
            $result['data'][$i][3] = $item->filename;
            $result['data'][$i][4] = $item->process_rows;
            if(null !== $item->dataset) {
                $result['data'][$i][5] = $item->mydataset->name;
                if($item->status == 1) {
                    $result['data'][$i][6] = "<span class='label label-success inactive'>Completed</span>";
                    $result['data'][$i][8] = '<a href="#" class="btn btn-custom btn-square download-btn" onclick="event.preventDefault();document.getElementById(\'download-form-'.$item->id.'\').submit();">Download</a>'.
                    '<form method="POST" id="download-form-'.$item->id.'" action="'.route('admin.download').'" style="display:none;"><input type="hidden" name="_token" value="'.csrf_token().
                    '" /><input type="text" name="_download_token" value="'.$item->table_name.'" /></form>';
                    $result['data'][$i][9] = '<a href="#" class="btn btn-custom btn-square download-btn" onclick="event.preventDefault();document.getElementById(\'report-form-'.$item->id.'\').submit();">Download</a>'.
                    '<form method="POST" id="report-form-'.$item->id.'" action="'.route('admin.report').'" style="display:none;"><input type="hidden" name="_token" value="'.csrf_token().
                    '" /><input type="text" name="_download_token" value="'.$item->table_name.'" /></form>';
                }
                else {
                    $result['data'][$i][6] = "<span class='label label-primary inactive'>In progress</span>";
                    $result['data'][$i][8] = "";
                    $result['data'][$i][9] = "";
                }
            }
            else {
                $result['data'][$i][5] = "None";
                if($item->status == 1) {
                    $result['data'][$i][6] = "<span class='label label-success inactive'>Completed</span>";
                    $result['data'][$i][8] = '<a href="#" class="btn btn-primary download-btn" onclick="event.preventDefault();document.getElementById(\'download-form-'.$item->id.'\').submit();">Download</a>'.
                    '<form method="POST" id="download-form-'.$item->id.'" action="'.route('admin.download').'" style="display:none;"><input type="hidden" name="_token" value="'.csrf_token().
                    '" /><input type="text" name="_download_token" value="'.$item->table_name.'" /></form>';
                    $result['data'][$i][9] = '<a href="#" class="btn btn-custom btn-square download-btn" onclick="event.preventDefault();document.getElementById(\'report-form-'.$item->id.'\').submit();">Download</a>'.
                    '<form method="POST" id="report-form-'.$item->id.'" action="'.route('admin.report').'" style="display:none;"><input type="hidden" name="_token" value="'.csrf_token().
                    '" /><input type="text" name="_download_token" value="'.$item->table_name.'" /></form>';
                }
                else {
                    $result['data'][$i][6] = "<span class='label label-danger inactive'>Failed</span>";
                    $result['data'][$i][8] = "";
                    $result['data'][$i][9] = "";
                }
            }
            $result['data'][$i][7] = date($item->created_at);
            $i++;
        }

        return response()->json($result);
    }

    public function delete(Request $request) {
        Filelist::find($request->id)->delete();
        return 'success';
    }
}
