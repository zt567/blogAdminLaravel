<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    //
    public function index(){
        return view('admin.index');
    }
    public function info(){
        return view('admin.info');
    }
    
    public function pass(){
        if($input = Input::all()){
            $rules = [
                'password'=>'required || between:1,20 || confirmed',
            ];
            $message = [
                'password.required'=>'新密碼不得為空!',
                'password.between'=>'密碼要求1-20位之間!',
                'password.confirmed'=>'新密碼與確認密碼不一致!',
            ];

            $validator = Validator::make($input,$rules,$message);

            if($validator->passes()){
                $user = User::first();
                $_password = Crypt::decrypt($user->user_pass);
                if($input['password_o']==$_password){
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors','修改成功');
                }else{
                    return back()->with('errors','原密碼錯誤');
                }
            }else{
                return back()->withErrors($validator);
                
            }
        }else{
            return view('admin.pass');
        }
        
    }
}
