<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pricing;
use Stripe;
use Auth;
use Session;

class PricingController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','verified']);
    }

    public function index(Request $request) {
        $index = "index-1";
        $menu = '';
        $pricing_id = $request->get('_id');

        $pricing = Pricing::where('id','=',$pricing_id)->first();

        return view('stripe', compact('index','menu','pricing'));
    }

    public function stripePost(Request $request) {
        $pricing_id = $request->get('_id');

        $pricing = Pricing::where('id','=',$pricing_id)->first();
        $customer = Auth::user()->f_name.' '.Auth::user()->l_name.' - '.Auth::user()->email;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => 100 * $pricing->price,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Package(".$pricing->name.") purchase payment from ".$customer." customer."
        ]);
  
        Session::flash('success', 'Payment successful!');
        $index = "none-fixed-footer";
        $menu = 'package';

        $pricings = Pricing::all();

        return view('package', compact('index','menu','pricings'));
    }
}