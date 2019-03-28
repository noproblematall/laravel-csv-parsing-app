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

class DatasetController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','verified','admin']);
    }

    public function index() {
        $index = 'dataset';
        return view('admin.dataset', compact('index'));
    }
}
