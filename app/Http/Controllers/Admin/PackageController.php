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

class PackageController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','verified','admin']);
    }

    public function index() {
        $index = 'package';
        $title = 'Package management';
        $pricings = Pricing::all();
        return view('admin.package', compact('index','pricings','title'));
    }

    public function pre_add(Request $request) {
        $index = 'package';
        $title = 'Package management';
        return view('admin.new_package', compact('index','title'));
    }

    public function add(Request $request) {
        $price = new Pricing;
        $price->name = $request->get('title');
        $price->price = $request->get('price');
        $price->rows = $request->get('rows');
        $price->description = $request->get('description');
        $price->active = $request->get('active');
        $price->save();

        $index = 'package';
        $pricings = Pricing::all();

        return redirect('admin/package');
    }

    public function pre_edit(Request $request,$id) {
        $package = Pricing::where('id','=',$id)->first();
        $title = 'Package management';

        return view('admin.pk_edit', compact('package','title'));
    }

    public function edit(Request $request) {
        $package = Pricing::where('id',$request->get('id'))->first();
        $package->name = $request->get('title');
        $package->price = $request->get('price');
        $package->rows = $request->get('rows');
        $package->description = $request->get('description');
        $package->active = $request->get('active');
        $package->save();

        return back();
    }

    public function delete(Request $request) {
        Pricing::find($request->get('_id'))->delete();

        return 'success';
    }

    public function makeActive(Request $request) {
        $pricing = Pricing::find($request->get('_id'));
        $pricing->active = 1;
        $pricing->save();

        return 'success';
    }

    public function makeInactive(Request $request) {
        $pricing = Pricing::find($request->get('_id'));
        $pricing->active = 0;
        $pricing->save();

        return 'success';
    }
}
