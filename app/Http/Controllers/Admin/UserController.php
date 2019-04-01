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
use Auth;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','verified','admin']);
    }

    public function index() {
        $index = 'user';
        $title = 'User management';
        return view('admin.user', compact('index','title'));
    }

    public function getUserList() {
        $users = User::where([
            ['id','!=',Auth::user()->id],
        ])->get();

        $result = [];
        $result['data'] = [];
        $i = 0;
        foreach($users as $user) {
            $result['data'][$i][0] = $i+1;
            $result['data'][$i][1] = $user->f_name;
            $result['data'][$i][2] = $user->l_name;
            $result['data'][$i][3] = "<a href='mailto:".$user->email."' class='email'>".$user->email."</a>";
            
            if(null !== $user->pricing) {
                if(null !== $user->processed) {
                    $result['data'][$i][4] = strtoupper($user->package->name);
                    $result['data'][$i][5] = $user->package->rows - $user->processed;
                }
                else {
                    $result['data'][$i][4] = $user->package->name;
                    $result['data'][$i][5] = $user->package->rows - 0;
                }
            }
            else {
                $result['data'][$i][4] = 'NONE';
                $result['data'][$i][5] = 0;
            }
            
            $result['data'][$i][6] = $user->mobile;
            $result['data'][$i][7] = $user->birthday;
            $result['data'][$i][8] = $user->location;
            if($user->gender=='M') {
                $result['data'][$i][9] = 'Male';
            }
            else if($user->gender=='F') {
                $result['data'][$i][9] = 'Female';
            }
            else {
                $result['data'][$i][9] = '';
            }
            $result['data'][$i][10] = $user->created_at;
            if($user->active) {
                $result['data'][$i][11] = "<span class='label label-success inactive'>Active</span>";
            }
            else {
                $result['data'][$i][11] = "<span class='label label-danger inactive'>Inactive</span>";
            }
            
            $i++;
        }

        return response()->json($result);
    }

    public function makeActive(Request $request) {
        $user = User::where('email','=',$request->get('user_id'))->first();
        $user->active = 1;
        $user->save();

        return "success";
    }

    public function makeInactive(Request $request) {
        $user = User::where('email','=',$request->get('user_id'))->first();
        $user->active = 0;
        $user->save();

        return "success";
    }

    public function delete(Request $request) {
        User::where('email','=',$request->get('user_id'))->delete();

        return "success";
    }
}
