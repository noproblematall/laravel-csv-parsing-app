<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filelist;
use App\Dataset;
use App\Payments;
use App\User;
use Auth;
use route;
use Illuminate\Support\Facades\Validator;
use Hash;
use Session;

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

        if(null !== Auth::user()->pricing && 0 !== Auth::user()->pricing) {
            $current_plan = Auth::user()->package->rows;
            if(null !== Auth::user()->processed) {
                $processable_rows = Auth::user()->package->rows - Auth::user()->processed;
            }
            else {
                $processable_rows = Auth::user()->package->rows - 0;
            }
        }
        else {
            $current_plan = 0;
            $processable_rows = 0;
        }
    
        $user = User::where('id','=',Auth::user()->id)->first();

        $active = 'completed';
        $menu = 'dashboard';
        $subpage = 'User Dashboard';
        if($user->birthday == "") {
            $birth[0] = "";
            $birth[1] = "";
            $birth[2] = "";
        }
        else {
            $birth = explode('/',$user->birthday);
        }
        

        return view('user.index', compact('active','processing_files_count','completed_files_count','menu','current_plan','processable_rows','user','subpage','birth'));
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

        if(null !== Auth::user()->pricing && 0 !== Auth::user()->pricing) {
            $current_plan = Auth::user()->package->rows;
            if(null !== Auth::user()->processed) {
                $processable_rows = Auth::user()->package->rows - Auth::user()->processed;
            }
            else {
                $processable_rows = Auth::user()->package->rows - 0;
            }
        }
        else {
            $current_plan = 0;
            $processable_rows = 0;
        }

        $user = User::where('id','=',Auth::user()->id)->first();

        if($user->birthday == "") {
            $birth[0] = "";
            $birth[1] = "";
            $birth[2] = "";
        }
        else {
            $birth = explode('/',$user->birthday);
        }

        $active = 'info';
        $menu = 'dashboard';
        $subpage = 'User Dashboard';

        return view('user.index', compact('active','processing_files_count','completed_files_count','menu','current_plan','processable_rows','user','subpage','birth'));
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
            $current_plan = 0;
            $processable_rows = 0;
        }

        $user = User::where('id','=',Auth::user()->id)->first();

        if($user->birthday == "") {
            $birth[0] = "";
            $birth[1] = "";
            $birth[2] = "";
        }
        else {
            $birth = explode('/',$user->birthday);
        }
        
        $active = 'chang_pwd';
        $menu = 'dashboard';
        $subpage = 'User Dashboard';

        return view('user.index', compact('active','processing_files_count','completed_files_count','menu','current_plan','processable_rows','user','subpage','birth'));
    }

    public function payment_history() {
        $processing_files_count = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',0]
        ])->count();

        $completed_files_count = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',1]
        ])->count();

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
            $current_plan = 0;
            $processable_rows = 0;
        }
        $user = User::where('id','=',Auth::user()->id)->first();

        if($user->birthday == "") {
            $birth[0] = "";
            $birth[1] = "";
            $birth[2] = "";
        }
        else {
            $birth = explode('/',$user->birthday);
        }
        
        $active = 'payment';
        $menu = 'dashboard';
        $subpage = 'User Dashboard';
        
        return view('user.index', compact('active','processing_files_count','completed_files_count','menu','current_plan','processable_rows','user','subpage','birth'));
    }

    public function getProcessingList() {
        $filelist = Filelist::where([
            ['user_id','=',Auth::user()->id],
            ['status','=',0],
            ['table_name','!=',null]
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
            $result['data'][$i][5] = date($item->created_at);
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
            $result['data'][$i][4] = date($item->updated_at);
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
            $result['data'][$i][2] = '<a href="#" class="download-btn" onclick="event.preventDefault();document.getElementById(\'download-form-'.$item->id.'\').submit();"><i class="fas fa-download"></i></a>'.
            '<form method="POST" id="download-form-'.$item->id.'" action="'.route('download').'" style="display:none;"><input type="hidden" name="_token" value="'.csrf_token().
            '" /><input type="text" name="_download_token" value="'.$item->table_name.'" /></form>';
            $i++;
        }

        return response()->json($result);
    }

    public function getPaymenthistory() {
        $pay_his = Payments::where([
            ['user_id','=',Auth::user()->id],
            ['status','=','succeeded']
        ])->get();

        $result = [];
        $result['data'] = [];
        $i = 0;
        foreach($pay_his as $item) {
            $result['data'][$i][0] = $i+1;
            $result['data'][$i][1] = date($item->created_at);
            $result['data'][$i][2] = strtoupper($item->package->name).' package purchase payment.';
            $result['data'][$i][3] = 'CAD';
            $result['data'][$i][4] = $item->package->price;
            $i++;
        }

        return response()->json($result);
    }

    public function getMobilePaymenthistory() {
        $pay_his = Payments::where([
            ['user_id','=',Auth::user()->id],
            ['status','=','succeeded']
        ])->get();

        $result = [];
        $result['data'] = [];
        $i = 0;
        foreach($pay_his as $item) {
            $result['data'][$i][0] = strtoupper($item->package->name).' package purchase payment.';
            $result['data'][$i][1] = '$'.$item->package->price;
            $i++;
        }

        return response()->json($result);
    }

    public function set_personal_info(Request $request) {
        if($request->get('year') != "") {
            if($request->get('day') < 10) {
                $birth = $request->get('month').'/0'.$request->get('day').'/'.$request->get('year');
            }
            else {
                $birth = $request->get('month').'/'.$request->get('day').'/'.$request->get('year');
            }
        }
        else {
            $birth = "";
        }
        $user = User::where('id','=',Auth::user()->id)->first();
        $user->f_name = $request->get('first_name');
        $user->l_name = $request->get('last_name');
        $user->birthday = $birth;
        $user->mobile = $request->get('mobile');
        $user->location = $request->get('location');

        $user->save();

        return self::personal_info();
    }

    public function set_change_pwd(Request $request) {
        $validatedData = $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ]);

        $user = User::where('id','=',Auth::user()->id)->first();
        $user->password = Hash::make($request->get('password'));
        $user->save();

        Session::flash('success', 'Password changed successfully!');

        return self::change_pwd();
    }
}
