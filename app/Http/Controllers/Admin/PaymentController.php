<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Filelist;
use App\Payments;
use App\Pricing;
use App\User;
use App\Dataset;
use App\Settings;
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
            $tax_rate = (Settings::first()->tax_rate)/100;
            $result['data'][$i][4] = round($pay->package->price + $pay->package->price * $tax_rate, 2);
            $result['data'][$i][5] = 'CAD';
            if($pay->status == "succeeded") {
                $result['data'][$i][6] = "<span class='label label-success inactive'>Succeeded</span>";
            }
            else {
                $result['data'][$i][6] = "<span class='label label-danger inactive'>Failed</span>";
            }
            $result['data'][$i][7] = date($pay->created_at);
            $result['data'][$i][8] = '<a href="#" class="btn btn-custom btn-square download-btn" onclick="event.preventDefault();document.getElementById(\'invoice-form-'.$pay->id.'\').submit();">Download</a>'.
            '<form method="POST" id="invoice-form-'.$pay->id.'" action="'.route('invoice').'" style="display:none;"><input type="hidden" name="_token" value="'.csrf_token().
            '" /><input type="text" name="_payment_id" value="'.$pay->id.'" /></form>';
            $i++;
        }

        return response()->json($result);
    }

    public function delete(Request $request) {
        Payments::find($request->get('id'))->delete();
        Filelist::where('dataset','=',$request->get('id'))->delete();
        return 'success';
    }
}
