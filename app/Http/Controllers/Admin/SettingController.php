<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings;
use DB;

class SettingController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','verified','admin']);
    }

    public function index() {
        $index = 'setting';
        $title = 'Settings management';
        $tab = 'seo';
        $settings = Settings::first();
        return view('admin.settings', compact('index','tab','title','settings'));
    }

    public function addSeo(Request $request) {
        $validatedData = $request->validate([
            'logo' => 'mimes:jpeg,png',
            'fav' => 'mimes:png,ico',
        ]);

        if(null !== $request->file('logo')) {
            $logo = time().'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('/assets/logo'), $logo);
            $setting = Settings::where('id',1)->first();
            $setting->logo = $logo;
            $setting->save();
        }

        if(null !== $request->file('fav')) {
            $fav = time().'.'.$request->file('fav')->getClientOriginalExtension();
            $request->file('fav')->move(public_path('/assets/favicon'), $fav);
            $setting = Settings::where('id',1)->first();
            $setting->fav_icon = $fav;
            $setting->save();
        }

        if(null !== $request->get('meta_title')) {
            $setting = Settings::where('id',1)->first();
            $setting->app_name = $request->get('app_name');
            $setting->save();
        }

        if(null !== $request->get('meta_title')) {
            $setting = Settings::where('id',1)->first();
            $setting->meta_title = $request->get('meta_title');
            $setting->save();
        }

        if(null !== $request->get('meta_key')) {
            $setting = Settings::where('id',1)->first();
            $setting->meta_keywords = $request->get('meta_key');
            $setting->save();
        }

        if(null !== $request->get('meta_des')) {
            $setting = Settings::where('id',1)->first();
            $setting->meta_description = $request->get('meta_des');
            $setting->save();
        }

        if(null !== $request->get('google_analytics')) {
            $setting = Settings::where('id',1)->first();
            $setting->google_analytics = $request->get('google_analytics');
            $setting->save();
        }

        $index = 'setting';
        $title = 'Settings management';
        $tab = 'seo';
        $settings = Settings::first();
        return view('admin.settings', compact('index','tab','title','settings'));
    }

    public function addContact(Request $request) {
        if(null !== $request->get('email')) {
            $setting = Settings::where('id',1)->first();
            $setting->email = $request->get('email');
            $setting->save();
        }
        if(null !== $request->get('phone')) {
            $setting = Settings::where('id',1)->first();
            $setting->phone = $request->get('phone');
            $setting->save();
        }
        if(null !== $request->get('fax')) {
            $setting = Settings::where('id',1)->first();
            $setting->fax = $request->get('fax');
            $setting->save();
        }
        if(null !== $request->get('address')) {
            $setting = Settings::where('id',1)->first();
            $setting->address = $request->get('address');
            $setting->save();
        }

        $index = 'setting';
        $title = 'Settings management';
        $tab = 'contact';
        $settings = Settings::first();

        return view('admin.settings', compact('index','tab','title','settings'));
    }

    public function addOther(Request $request) {
        if(null !== $request->get('banner')) {
            $setting = Settings::where('id',1)->first();
            $setting->banner_text = $request->get('banner');
            $setting->save();
        }
        if(null !== $request->get('pk_title')) {
            $setting = Settings::where('id',1)->first();
            $setting->pk_title = $request->get('pk_title');
            $setting->save();
        }
        if(null !== $request->get('pk_text')) {
            $setting = Settings::where('id',1)->first();
            $setting->pk_text = $request->get('pk_text');
            $setting->save();
        }
        if(null !== $request->get('md_title')) {
            $setting = Settings::where('id',1)->first();
            $setting->md_title = $request->get('md_title');
            $setting->save();
        }
        if(null !== $request->get('md_text')) {
            $setting = Settings::where('id',1)->first();
            $setting->md_text = $request->get('md_text');
            $setting->save();
        }
        if(null !== $request->get('ft_text')) {
            $setting = Settings::where('id',1)->first();
            $setting->foot_text = $request->get('ft_text');
            $setting->save();
        }

        $index = 'setting';
        $title = 'Settings management';
        $tab = 'other';
        $settings = Settings::first();

        return view('admin.settings', compact('index','tab','title','settings'));
    }
}
