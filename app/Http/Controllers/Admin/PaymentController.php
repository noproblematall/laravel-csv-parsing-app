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

class PaymentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','verified','admin']);
    }

    public function index() {
        $index = 'payment';
        $title = 'Payment History';
        return view('admin.payment', compact('index','title'));
    }

    public function getPayment(Request $request) {
        $payments = Payments::all();

        $result = [];
        $result['data'] = [];
        $i = 0;
        foreach($payments as $pay) {
            $result['data'][$i][0] = $i+1;
            $result['data'][$i][1] = "<span class='payment_id'>".$pay->id."</span>";
            $result['data'][$i][2] = $pay->user->f_name.' '.$pay->user->l_name;
            $result['data'][$i][3] = strtoupper($pay->package->name);
            $result['data'][$i][4] = $pay->package->price;
            $result['data'][$i][5] = 'CAD';
            if($pay->status == "succeeded") {
                $result['data'][$i][6] = "<span class='label label-success inactive'>Succeeded</span>";
            }
            else {
                $result['data'][$i][6] = "<span class='label label-danger inactive'>Failed</span>";
            }
            $result['data'][$i][6] = $pay->created_at;
            $i++;
        }

        return response()->json($result);
    }

    public function delete(Request $request) {
        Payments::find($request->get('id'))->delete();
        return 'success';
    }
}
