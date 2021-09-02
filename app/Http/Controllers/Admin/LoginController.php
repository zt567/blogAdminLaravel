<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    //
    public function login(){
        //submit後才執行
        if($input = Input::all()){
            $code = new \Code;
            $getcode = $code->get();
            if(strtoupper($input['code'])!=$getcode){
                return back()->with('msg','驗證碼錯誤');
            }
            //資料庫確認
            $user = User::first();
            if($user->user_name != $input['user_name']||Crypt::decrypt($user->user_pass)!=$input['user_pass']){
                return back()->with('msg','用戶名或密碼錯誤');
            }
            //確認無誤存至session
            session(['user'=>$user]);
            return redirect('admin/index');
        }else{
            return view('admin.login');
        }
        
    }

    public function quit(){
        session(['user'=>null]);
        return redirect('admin/login');
    }

    public function crypt(){
        $user = User::all();
        echo $user;
    }

    public function makecode(){
        $code = new \Code;
        echo $code->make(); 
    }

    public function getcode(){
        $code = new \Code;
        echo $code->get(); 
    }
    public function root(){
        return view('welcome');
    }

}
