<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Auth;
use Session;
use App\Pricing;
use App\User;
use App\Payments;

class PricingController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','verified']);
    }

    public function index(Request $request) {
        $index = "index-1 stripe";
        $pricing_id = $request->get('_id');

        $pricing = Pricing::where('id','=',$pricing_id)->first();
        $subpage = 'Payment';

        return view('stripe', compact('index','pricing','subpage'));
    }

    public function stripePost(Request $request) {
        $pricing_id = $request->get('_id');

        $pricing = Pricing::where('id','=',$pricing_id)->first();
        $customer = Auth::user()->f_name.' '.Auth::user()->l_name.' - '.Auth::user()->email;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $paid = Stripe\Charge::create ([
            "amount" => 100 * $pricing->price,
            "currency" => "usd",
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

            Session::flash('success', 'Payment successful!');
        }
        else {
            Session::flash('error', 'Payment failed!');
        }

        return redirect('/packages');
    }

    public function test() {
        return response()->json(Auth::user()->package->rows);
    }
}