<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Auth;
use Session;
use App\Pricing;
use App\User;
use App\Payments;
use App\Settings;
use App\Notifications\Payment;
use PDF;

class PricingController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','verified']);
    }

    public function index(Request $request) {
        $index = "index-1 stripe";
        $pricing_id = $request->get('_id');

        $pricing = Pricing::where('id','=',$pricing_id)->first();
        $tax_rate = (Settings::first()->tax_rate)/100;
        $total_price = round($pricing->price + $pricing->price * $tax_rate, 2);

        $menu = 'package';
        $subpage = 'Payment';

        return view('stripe', compact('index','pricing','menu','subpage','total_price'));
    }

    public function stripePost(Request $request) {
        $pricing_id = $request->get('_id');

        $pricing = Pricing::where('id','=',$pricing_id)->first();
        $tax_rate = (Settings::first()->tax_rate)/100;
        $total_price = round($pricing->price + $pricing->price * $tax_rate, 2);

        $customer = Auth::user()->f_name.' '.Auth::user()->l_name.' - '.Auth::user()->email;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $paid = Stripe\Charge::create ([
            "amount" => 100 * $total_price,
            "currency" => "cad",
            "source" => $request->stripeToken,
            "description" => "Package(".$pricing->name.") purchase payment from ".$customer." customer."
        ]);

        if($paid->paid && $paid->status == 'succeeded') {
            $user = User::where('id',Auth::user()->id)->first();
            $user->pricing = $pricing_id;
            $user->processed = 0;
            $user->save();

            $payment = new Payments;
            $payment->user_id = Auth::user()->id;
            $payment->pricing_id = $pricing_id;
            $payment->status = $paid->status;
            $payment->save();

            $user = Auth::user();
            $user->notify(new Payment($payment));

            Session::flash('success', 'Payment successful!');
        }
        else {
            Session::flash('error', 'Payment failed!');
        }

        return redirect('/packages');
    }

    public function download(Request $request) {
        $id = $request->get('_payment_id');
        $payment = Payments::where('id','=',$id)->first();

        $pdf = PDF::loadView('user.invoice', compact('payment'));
        return $pdf->download('PushPolitics-Invoice-'.$payment->created_at->format('mdy').'.pdf');
    }

    public function test() {
        $payment = Payments::first();

        return view('user.invoice', compact('payment'));
    }
}