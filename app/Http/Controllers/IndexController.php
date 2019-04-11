<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pricing;
use App\Settings;
use App\User;
use App\Notifications\ContactUs;
use Session;

class IndexController extends Controller
{
    public function __contruct() {

    }

    public function index() {
        $index = "index";
        $menu = '';
        $pricings = Pricing::where('active','=',1)->get();
        $subpage = 'Home';
        return view('index', compact('index','menu','pricings','subpage'));
    }

    public function contact(Request $request) {
        $index = "index-1";
        $menu = 'contact';
        $subpage = 'Contact Us';
        return view('contact', compact('index','menu','subpage'));
    }

    public function do_contact(Request $request) {
        $data = [];
        $data['name'] = $request->get('name');
        $data['email'] = $request->get('email');
        $data['phone'] = $request->get('phone');
        $data['message'] = $request->get('message');

        Settings::first()->notify(new ContactUs($data));

        Session::flash('success', 'Your message sent successfully!');

        return back();
    }
}
