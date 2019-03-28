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

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','verified','admin']);
    }

    public function index() {
        $index = 'user';
        return view('admin.user', compact('index'));
    }

    public function getUserList() {
        $users = User::where([
            ['role','!=','admin'],
        ])->get();

        $result = [];
        $result['data'] = [];
        $i = 0;
        foreach($users as $user) {
            $result['data'][$i][0] = $i+1;
            $result['data'][$i][1] = $user->f_name;
            $result['data'][$i][2] = $user->l_name;
            $result['data'][$i][3] = $user->email;
            
            if(null !== $user->pricing) {
                $current_plan = Auth::user()->package->rows;
                if(null !== Auth::user()->processed) {
                    $result['data'][$i][4] = $user->package->name;
                    $result['data'][$i][5] = $user->package->rows - $user->processed;
                }
                else {
                    $result['data'][$i][4] = $user->package->name;
                    $result['data'][$i][5] = $user->package->rows - 0;
                }
            }
            else {
                $result['data'][$i][4] = 'None';
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
            $result['data'][$i][11] = $user->active;
            $i++;
        }

        return response()->json($result);
    }
}
