<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class IndexController extends CommonController
{
    //
    public function index(){
        return view('admin.index');
    }
    public function info(){
        return view('admin.info');
    }
}
