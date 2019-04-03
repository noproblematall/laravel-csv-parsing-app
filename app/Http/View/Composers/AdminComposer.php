<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Settings;
use App\Dataset;
use App\Filelist;
use App\Payments;
use App\Pricing;
use App\User;

class AdminComposer
{
    public function compose(View $view)
    {
        $count = [];
        $count['user_active'] = User::where('active','=',1)->get()->count() - 1;
        $count['user_inactive'] = User::where('active','=',0)->get()->count();
        if($count['user_active'] == 0) {
            $count['user_active'] = null;
        }
        if($count['user_inactive'] == 0) {
            $count['user_inactive'] = null;
        }

        $count['dataset_active'] = Dataset::where('active','=',1)->get()->count();
        $count['dataset_inactive'] = Dataset::where('active','=',0)->get()->count();
        if($count['dataset_inactive'] == 0) {
            $count['dataset_inactive'] = null;
        }
        if($count['dataset_inactive'] == 0) {
            $count['dataset_inactive'] = null;
        }

        $count['package_active'] = Pricing::where('active','=',1)->get()->count();
        $count['package_inactive'] = Pricing::where('active','=',0)->get()->count();
        if($count['package_active'] == 0) {
            $count['package_active'] = null;
        }
        if($count['package_inactive'] == 0) {
            $count['package_inactive'] = null;
        }

        $count['process_active'] = Filelist::where('status','=',1)->get()->count();
        $count['process_inactive'] = Filelist::where('status','=',0)->get()->count();
        if($count['process_active'] == 0) {
            $count['process_active'] = null;
        }
        if($count['process_inactive'] == 0) {
            $count['process_inactive'] = null;
        }

        $count['payment'] = Payments::all()->count();
        if($count['payment'] == 0) {
            $count['payment'] = null;
        }


        $view->with('admin', $count);
    }
}